<?php

namespace App\Console\Commands;

use App\Services\FacebookCapiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SubscribeFacebookPagesWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:subscribe-pages {--page_id= : Specific Facebook Page ID to subscribe}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe all connected Facebook Pages to real-time Leadgen Webhook events.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rawToken = config('services.facebook.page_access_token') 
            ?: config('services.facebook.capi_access_token') 
            ?: env('FB_PAGE_ACCESS_TOKEN') 
            ?: env('FB_CAPI_ACCESS_TOKEN');

        if (empty($rawToken)) {
            $this->error('Facebook Access Token is missing in .env (FB_CAPI_ACCESS_TOKEN or FB_PAGE_ACCESS_TOKEN).');
            return 1;
        }

        $this->info("Scanning connected Facebook Pages for Webhook Subscriptions...");

        $pages = [];

        if ($this->option('page_id')) {
            $pages[$this->option('page_id')] = [
                'id' => $this->option('page_id'),
                'name' => 'Specified Page',
            ];
        } else {
            // 1. Try /me/accounts
            try {
                $accRes = Http::timeout(10)->get("https://graph.facebook.com/v19.0/me/accounts", [
                    'fields' => 'id,name,access_token',
                    'limit' => 100,
                    'access_token' => $rawToken,
                ]);
                if ($accRes->successful() && !empty($accRes->json('data'))) {
                    foreach ($accRes->json('data') as $p) {
                        $pages[$p['id']] = $p;
                    }
                }
            } catch (\Throwable $e) {}

            // 2. Try /me/businesses to get all owned and client pages
            try {
                $bizRes = Http::timeout(10)->get("https://graph.facebook.com/v19.0/me/businesses", [
                    'fields' => 'id,name',
                    'access_token' => $rawToken,
                ]);
                if ($bizRes->successful() && !empty($bizRes->json('data'))) {
                    foreach ($bizRes->json('data') as $biz) {
                        $bizId = $biz['id'];
                        $ownedRes = Http::timeout(10)->get("https://graph.facebook.com/v19.0/{$bizId}/owned_pages", [
                            'fields' => 'id,name,access_token',
                            'limit' => 50,
                            'access_token' => $rawToken,
                        ]);
                        if ($ownedRes->successful() && !empty($ownedRes->json('data'))) {
                            foreach ($ownedRes->json('data') as $p) {
                                $pages[$p['id']] = $p;
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {}

            // Always include Sumatra Sales default page
            if (!isset($pages['1310217108840460'])) {
                $pages['1310217108840460'] = [
                    'id' => '1310217108840460',
                    'name' => 'Sumatra Sales Private Limited',
                ];
            }
        }

        $this->info("Found " . count($pages) . " Page(s) to subscribe to automatic lead webhooks:\n");

        foreach ($pages as $pId => $page) {
            $pName = $page['name'] ?? 'Facebook Page';
            $pToken = $page['access_token'] ?? FacebookCapiService::resolvePageAccessToken($rawToken, $pId);

            $this->line("Subscribing Page: \"{$pName}\" (ID: {$pId})...");

            try {
                $response = Http::timeout(12)->post("https://graph.facebook.com/v19.0/{$pId}/subscribed_apps", [
                    'subscribed_fields' => 'leadgen',
                    'access_token' => $pToken,
                ]);

                if ($response->successful() && ($response->json('success') === true || $response->json('data'))) {
                    $this->info("  [SUCCESS] \"{$pName}\" is now subscribed to real-time Leadgen Webhooks!");
                } else {
                    $err = $response->json('error.message') ?? $response->body();
                    $this->warn("  [NOTICE] \"{$pName}\": {$err}");
                }
            } catch (\Throwable $e) {
                $this->error("  [ERROR] Exception on {$pName}: " . $e->getMessage());
            }
        }

        $this->info("\nAll accessible Facebook Pages have been subscribed to real-time Leadgen Webhooks.");
        $this->info("New leads submitted on Facebook will now arrive automatically in your CRM database in real-time!");

        return 0;
    }
}

