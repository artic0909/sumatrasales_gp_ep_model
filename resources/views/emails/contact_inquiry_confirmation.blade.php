<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Received - Sumatra Sales</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e3a8a 0%, #2964F2 100%); padding: 30px 28px; text-align: center;">
                            <h1 style="margin: 0; font-size: 22px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">SUMATRA SALES</h1>
                            <p style="margin: 5px 0 0 0; font-size: 12px; color: #bfdbfe; font-weight: 500;">Sumatra Sales Private Limited</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px 28px 24px 28px;">
                            <div style="text-align: center; margin-bottom: 22px;">
                                <div style="display: inline-block; background-color: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 50px; padding: 5px 14px; margin-bottom: 12px;">
                                    <span style="font-size: 12px; font-weight: 700; color: #047857; text-transform: uppercase; letter-spacing: 0.5px;">✓ Message Received</span>
                                </div>
                                <h2 style="margin: 0 0 6px 0; font-size: 19px; font-weight: 700; color: #0f172a;">Hello {{ $inquiry->name }},</h2>
                                <p style="margin: 0; font-size: 13.5px; line-height: 1.55; color: #475569;">
                                    Thank you for reaching out to Sumatra Sales. We have received your inquiry message and our administrative team will review it and get in touch with you shortly.
                                </p>
                            </div>

                            <!-- Summary Details Table -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 20px; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
                                <tr style="background-color: #f8fafc;">
                                    <td colspan="2" style="padding: 10px 14px; border-bottom: 1px solid #e2e8f0; font-size: 12.5px; font-weight: 700; color: #334155;">
                                        Your Inquiry Summary
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; width: 35%; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Inquiry Topic</td>
                                    <td style="padding: 9px 14px; font-size: 12.5px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        <span style="display: inline-block; background-color: #eff6ff; color: #1d4ed8; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 4px;">
                                            {{ $inquiry->inquiry_type }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Your Name</td>
                                    <td style="padding: 9px 14px; font-size: 12.5px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $inquiry->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Contact Mobile</td>
                                    <td style="padding: 9px 14px; font-size: 12.5px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $inquiry->phone }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Email Address</td>
                                    <td style="padding: 9px 14px; font-size: 12.5px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $inquiry->email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; font-size: 12.5px; color: #64748b;">Submitted At</td>
                                    <td style="padding: 9px 14px; font-size: 12.5px; font-weight: 600; color: #0f172a;">
                                        {{ ($inquiry->created_at ? $inquiry->created_at->timezone('Asia/Kolkata')->format('d M, Y - h:i A') : now('Asia/Kolkata')->format('d M, Y - h:i A')) }} (IST)
                                    </td>
                                </tr>
                            </table>

                            <!-- Message Box -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 16px; margin-bottom: 22px;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 6px;">Message Sent:</div>
                                <div style="font-size: 13px; line-height: 1.55; color: #1e293b; white-space: pre-wrap;">{{ $inquiry->message }}</div>
                            </div>

                            <p style="margin: 0; font-size: 12.5px; line-height: 1.5; color: #64748b; text-align: center;">
                                If your matter is urgent, feel free to reply directly to this email or reach us at <a href="mailto:sumatra.sales2424@gmail.com" style="color: #2563eb; text-decoration: underline;">sumatra.sales2424@gmail.com</a>.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 18px 28px; text-align: center;">
                            <p style="margin: 0; font-size: 11.5px; color: #94a3b8;">
                                © {{ date('Y') }} Sumatra Sales Private Limited. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
