<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Partner Application Received - Admin Notification</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 620px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #0f172a; padding: 26px 30px; text-align: left; border-bottom: 3px solid {{ $partner->registration_type === 'GP' ? '#10b981' : '#3b82f6' }};">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td>
                                        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">Sumatra Sales Admin Alert</div>
                                        <h1 style="margin: 4px 0 0 0; font-size: 20px; font-weight: 800; color: #ffffff;">New {{ $partner->registration_type === 'GP' ? 'Ground Partner (GP)' : 'Executive Partner (EP)' }} Application</h1>
                                    </td>
                                    <td align="right">
                                        <span style="display: inline-block; background-color: {{ $partner->registration_type === 'GP' ? '#065f46' : '#1e3a8a' }}; color: #ffffff; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 20px; letter-spacing: 0.5px;">
                                            {{ $partner->registration_type }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 28px 30px 20px 30px;">
                            <p style="margin: 0 0 20px 0; font-size: 14.5px; line-height: 1.5; color: #334155;">
                                A new partner registration form has been submitted on the Sumatra Sales portal. Below are the key applicant details:
                            </p>

                            <!-- Reference Badge Box -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 18px; margin-bottom: 22px;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>
                                            <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b;">Application Reference Code</div>
                                            <div style="font-size: 18px; font-weight: 800; color: #0f172a; font-family: 'Courier New', Courier, monospace; margin-top: 3px;">
                                                {{ $partner->application_code }}
                                            </div>
                                        </td>
                                        <td align="right">
                                            <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b;">Submitted On</div>
                                            <div style="font-size: 13px; font-weight: 600; color: #334155; margin-top: 3px;">
                                                {{ ($partner->created_at ? $partner->created_at->timezone('Asia/Kolkata')->format('d M, Y - h:i A') : now('Asia/Kolkata')->format('d M, Y - h:i A')) }}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Applicant Personal Information -->
                            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 8px;">1. Personal & Contact Details</div>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 20px; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 9px 14px; width: 35%; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Full Name</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $partner->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Mobile Number</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        <a href="tel:{{ $partner->phone }}" style="color: #2563eb; text-decoration: none;">{{ $partner->phone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Email Address</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        <a href="mailto:{{ $partner->email }}" style="color: #2563eb; text-decoration: none;">{{ $partner->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Complete Address</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        {{ $partner->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">City / District / State</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        {{ $partner->city }} &bull; {{ $partner->district }} &bull; {{ $partner->state }}
                                    </td>
                                </tr>
                                @if(!empty($partner->interests))
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b;">Selected Projects</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a;">
                                        {{ is_array($partner->interests) ? implode(', ', $partner->interests) : $partner->interests }}
                                    </td>
                                </tr>
                                @endif
                            </table>

                            <!-- KYC & Banking Details -->
                            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 8px;">2. KYC & Banking Info</div>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 24px; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 9px 14px; width: 35%; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Aadhaar Number</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $partner->aadhaar_number }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">PAN Number</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $partner->pancard_number }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Bank Name</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $partner->bank_name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Account Number</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $partner->bank_account_number }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b;">IFSC Code</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a;">{{ $partner->ifsc_code }}</td>
                                </tr>
                            </table>

                            <!-- Action Buttons -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 10px;">
                                <tr>
                                    <td align="center" style="padding: 5px;">
                                        @php
                                            $adminShowRoute = $partner->registration_type === 'GP' 
                                                ? route('admin.gp.show', $partner->id) 
                                                : route('admin.ep.show', $partner->id);
                                        @endphp
                                        <a href="{{ $adminShowRoute }}" target="_blank" style="display: inline-block; background-color: #0f172a; color: #ffffff; text-decoration: none; padding: 12px 28px; font-size: 13.5px; font-weight: 600; border-radius: 6px; box-shadow: 0 2px 4px rgba(15, 23, 42, 0.2);">
                                            View in Admin Panel &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 18px 30px; text-align: center;">
                            <p style="margin: 0; font-size: 11.5px; color: #64748b;">
                                Automated notification generated by Sumatra Sales Admin System.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
