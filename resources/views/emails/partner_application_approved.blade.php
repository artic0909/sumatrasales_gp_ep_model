<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Approved - Sumatra Sales</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f5f9; padding: 32px 16px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 580px; background-color: #ffffff; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e3a8a 0%, #2964F2 100%); padding: 32px 28px; text-align: center;">
                            <h1 style="margin: 0; font-size: 22px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">SUMATRA SALES</h1>
                            <p style="margin: 4px 0 0 0; font-size: 12px; color: #bfdbfe; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Sumatra Sales Private Limited</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 32px 28px 24px 28px;">
                            <div style="text-align: center; margin-bottom: 22px;">
                                <div style="display: inline-block; background-color: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 50px; padding: 6px 18px; margin-bottom: 12px;">
                                    <span style="font-size: 12px; font-weight: 800; color: #047857; text-transform: uppercase; letter-spacing: 0.8px;">✓ Application Approved</span>
                                </div>
                                <h2 style="margin: 0 0 8px 0; font-size: 20px; font-weight: 700; color: #0f172a;">Dear {{ $partner->name }},</h2>
                                <p style="margin: 0; font-size: 14px; line-height: 1.6; color: #475569;">
                                    Congratulations! We are pleased to inform you that your application for the 
                                    <strong>{{ $partner->registration_type === 'GP' ? 'Ground Partner (GP)' : 'Executive Partner (EP)' }}</strong> 
                                    position has been officially approved.
                                </p>
                            </div>

                            <!-- Highlighted Partner Code Box -->
                            <div style="background: linear-gradient(to bottom right, #f8fafc, #eff6ff); border: 2px solid #2964F2; border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 24px;">
                                <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; color: #2563eb; margin-bottom: 6px;">Your Official Partner Code</div>
                                <div style="font-size: 28px; font-weight: 900; letter-spacing: 2px; color: #1e3a8a; font-family: 'Courier New', Courier, monospace;">
                                    {{ $partner->approved_code }}
                                </div>
                                <div style="font-size: 12px; color: #64748b; margin-top: 6px;">
                                    Application Ref: <strong>{{ $partner->application_code }}</strong>
                                </div>
                            </div>

                            <!-- Details Summary Table -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 22px; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; font-size: 13px;">
                                <tr style="background-color: #f8fafc;">
                                    <td colspan="2" style="padding: 10px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 700; color: #334155;">
                                        Partner Engagement Summary
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; width: 40%; color: #64748b; border-bottom: 1px solid #f1f5f9;">Partner Name</td>
                                    <td style="padding: 10px 16px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $partner->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Partner Role</td>
                                    <td style="padding: 10px 16px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        {{ $partner->registration_type === 'GP' ? 'Ground Partner (GP)' : 'Executive Partner (EP)' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Registered Mobile</td>
                                    <td style="padding: 10px 16px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $partner->phone }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Project Assignment</td>
                                    <td style="padding: 10px 16px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        {{ !empty($partner->interests) && is_array($partner->interests) ? implode(', ', $partner->interests) : 'All Projects' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; color: #64748b;">Approval Date</td>
                                    <td style="padding: 10px 16px; font-weight: 600; color: #0f172a;">
                                        {{ $partner->approved_at ? $partner->approved_at->timezone('Asia/Kolkata')->format('d M, Y - h:i A') : now('Asia/Kolkata')->format('d M, Y - h:i A') }} (IST)
                                    </td>
                                </tr>
                            </table>

                            <!-- Simple Next Steps -->
                            <div style="background-color: #f0fdf4; border-left: 4px solid #16a34a; border-radius: 6px; padding: 14px 16px; margin-bottom: 20px;">
                                <div style="font-size: 13px; font-weight: 700; color: #15803d; margin-bottom: 4px;">Important Note & Next Steps</div>
                                <div style="font-size: 12.5px; line-height: 1.5; color: #166534;">
                                    Please keep your Partner Code (<strong>{{ $partner->approved_code }}</strong>) safe. You will use this code to identify yourself for onboarding and commissions. Our operations team will reach out with your engagement guidelines.
                                </div>
                            </div>

                            <p style="margin: 0; font-size: 13px; color: #475569; line-height: 1.5;">
                                Welcome to Sumatra Sales. We look forward to a successful and fruitful partnership with you.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 28px; text-align: center;">
                            <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b;">
                                Sumatra Sales Private Limited • Support: <a href="mailto:sumatra.sales2424@gmail.com" style="color: #2563eb; text-decoration: underline;">sumatra.sales2424@gmail.com</a>
                            </p>
                            <p style="margin: 0; font-size: 11px; color: #94a3b8;">
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
