<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Website Contact Inquiry - Admin Alert</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #0f172a; padding: 24px 28px; text-align: left; border-bottom: 3px solid #2563eb;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td>
                                        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">Sumatra Sales Portal Alert</div>
                                        <h1 style="margin: 4px 0 0 0; font-size: 18px; font-weight: 800; color: #ffffff;">New Contact Inquiry Received</h1>
                                    </td>
                                    <td align="right">
                                        <span style="display: inline-block; background-color: #1e3a8a; color: #ffffff; font-size: 11px; font-weight: 700; padding: 5px 12px; border-radius: 20px;">
                                            {{ $inquiry->inquiry_type }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 26px 28px 20px 28px;">
                            <p style="margin: 0 0 18px 0; font-size: 14px; line-height: 1.5; color: #334155;">
                                A new inquiry has been submitted via the Sumatra Sales website contact form:
                            </p>

                            <!-- Details Table -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 20px; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 9px 14px; width: 35%; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Inquiry Type</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        {{ $inquiry->inquiry_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Sender Name</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $inquiry->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Phone / Mobile</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        <a href="tel:{{ $inquiry->phone }}" style="color: #2563eb; text-decoration: none;">{{ $inquiry->phone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Email Address</td>
                                    <td style="padding: 9px 14px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        <a href="mailto:{{ $inquiry->email }}" style="color: #2563eb; text-decoration: none;">{{ $inquiry->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Received At</td>
                                    <td style="padding: 9px 14px; font-size: 12.5px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        {{ ($inquiry->created_at ? $inquiry->created_at->timezone('Asia/Kolkata')->format('d M, Y - h:i A') : now('Asia/Kolkata')->format('d M, Y - h:i A')) }}
                                    </td>
                                </tr>
                                @if($inquiry->ip_address)
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b;">Sender IP</td>
                                    <td style="padding: 9px 14px; font-size: 12.5px; font-weight: 600; color: #0f172a;">{{ $inquiry->ip_address }}</td>
                                </tr>
                                @endif
                            </table>

                            <!-- Message Box -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 16px; margin-bottom: 22px;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 6px;">Message Content:</div>
                                <div style="font-size: 13.5px; line-height: 1.6; color: #0f172a; white-space: pre-wrap;">{{ $inquiry->message }}</div>
                            </div>

                            <!-- CTA Button -->
                            <div style="text-align: center; margin: 10px 0;">
                                <a href="{{ route('admin.contact.index') }}" target="_blank" style="display: inline-block; background-color: #0f172a; color: #ffffff; text-decoration: none; padding: 11px 26px; font-size: 13px; font-weight: 600; border-radius: 6px; box-shadow: 0 2px 4px rgba(15, 23, 42, 0.2);">
                                    View in Admin Inbox &rarr;
                                </a>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 28px; text-align: center;">
                            <p style="margin: 0; font-size: 11px; color: #64748b;">
                                Automated notification from Sumatra Sales Website Inbound Engine.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
