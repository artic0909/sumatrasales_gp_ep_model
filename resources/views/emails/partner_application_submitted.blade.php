<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Received - Sumatra Sales</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e3a8a 0%, #2964F2 100%); padding: 32px 30px; text-align: center;">
                            <h1 style="margin: 0; font-size: 24px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">SUMATRA SALES</h1>
                            <p style="margin: 6px 0 0 0; font-size: 13px; color: #bfdbfe; font-weight: 500;">Sumatra Sales Private Limited</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 32px 30px 24px 30px;">
                            <div style="text-align: center; margin-bottom: 24px;">
                                <div style="display: inline-block; background-color: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 50px; padding: 6px 16px; margin-bottom: 12px;">
                                    <span style="font-size: 13px; font-weight: 700; color: #047857; text-transform: uppercase; letter-spacing: 0.5px;">✓ Application Submitted Successfully</span>
                                </div>
                                <h2 style="margin: 0 0 8px 0; font-size: 20px; font-weight: 700; color: #0f172a;">Dear {{ $partner->name }},</h2>
                                <p style="margin: 0; font-size: 14px; line-height: 1.6; color: #475569;">
                                    Thank you for applying to become a partner with Sumatra Sales. We have successfully received your application for the 
                                    <strong>{{ $partner->registration_type === 'GP' ? 'Ground Partner (GP)' : 'Executive Partner (EP)' }}</strong> position.
                                </p>
                            </div>

                            <!-- Application Number Highlight Box -->
                            <div style="background-color: #f8fafc; border: 2px dashed #93c5fd; border-radius: 10px; padding: 18px 20px; text-align: center; margin-bottom: 26px;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #2563eb; margin-bottom: 4px;">Your Application Reference Number</div>
                                <div style="font-size: 22px; font-weight: 800; letter-spacing: 1px; color: #1e3a8a; font-family: 'Courier New', Courier, monospace;">
                                    {{ $partner->application_code }}
                                </div>
                                <div style="font-size: 11.5px; color: #64748b; margin-top: 5px;">Please save this reference code for all future communications.</div>
                            </div>

                            <!-- Summary Details Table -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 24px; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
                                <tr style="background-color: #f8fafc;">
                                    <td colspan="2" style="padding: 10px 16px; border-bottom: 1px solid #e2e8f0; font-size: 13px; font-weight: 700; color: #334155;">
                                        Application Summary
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; width: 40%; font-size: 13px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Applied Role</td>
                                    <td style="padding: 10px 16px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        {{ $partner->registration_type === 'GP' ? 'Ground Partner (GP)' : 'Executive Partner (EP)' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; font-size: 13px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Applicant Name</td>
                                    <td style="padding: 10px 16px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $partner->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; font-size: 13px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Mobile Number</td>
                                    <td style="padding: 10px 16px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $partner->phone }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; font-size: 13px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Email Address</td>
                                    <td style="padding: 10px 16px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $partner->email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; font-size: 13px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Location</td>
                                    <td style="padding: 10px 16px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        {{ implode(', ', array_filter([$partner->city, $partner->district, $partner->state])) }}
                                    </td>
                                </tr>
                                @if(!empty($partner->interests))
                                <tr>
                                    <td style="padding: 10px 16px; font-size: 13px; color: #64748b; border-bottom: 1px solid #f1f5f9;">Selected Project(s)</td>
                                    <td style="padding: 10px 16px; font-size: 13px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                                        {{ is_array($partner->interests) ? implode(', ', $partner->interests) : $partner->interests }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding: 10px 16px; font-size: 13px; color: #64748b;">Submitted At</td>
                                    <td style="padding: 10px 16px; font-size: 13px; font-weight: 600; color: #0f172a;">
                                        {{ ($partner->created_at ? $partner->created_at->timezone('Asia/Kolkata')->format('d M, Y - h:i A') : now('Asia/Kolkata')->format('d M, Y - h:i A')) }} (IST)
                                    </td>
                                </tr>
                            </table>

                            <!-- What Happens Next Section -->
                            <div style="background-color: #f0fdf4; border-left: 4px solid #16a34a; border-radius: 4px; padding: 14px 16px; margin-bottom: 26px;">
                                <div style="font-size: 13.5px; font-weight: 700; color: #15803d; margin-bottom: 4px;">What's Next?</div>
                                <div style="font-size: 13px; line-height: 1.5; color: #166534;">
                                    Our verification team is reviewing your documents and application details. Once verified and approved, your official 
                                    <strong>{{ $partner->registration_type === 'GP' ? 'GP Referral Code' : 'EP Code & Appointment Details' }}</strong> 
                                    will be sent to this email address.
                                </div>
                            </div>

                            <!-- PDF Download CTA Button -->
                            <div style="text-align: center; margin: 24px 0 16px 0;">
                                <a href="{{ route('partner.application.pdf', $partner->application_code) }}" target="_blank" style="display: inline-block; background-color: #2563eb; color: #ffffff; text-decoration: none; padding: 12px 28px; font-size: 13.5px; font-weight: 600; border-radius: 6px; box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);">
                                    Download Application PDF
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 22px 30px; text-align: center;">
                            <p style="margin: 0 0 6px 0; font-size: 12px; color: #64748b;">
                                Need help or have questions? Contact us at <a href="mailto:sumatra.sales2424@gmail.com" style="color: #2563eb; text-decoration: underline;">sumatra.sales2424@gmail.com</a>
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
