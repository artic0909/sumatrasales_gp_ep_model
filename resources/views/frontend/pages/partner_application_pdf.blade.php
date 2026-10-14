<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sumatra Sales - Partner Application {{ $partner->application_code }}</title>
    <style>
        @page {
            margin: 24px 28px 28px 28px;
            size: a4 portrait;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.45;
            color: #1e293b;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table {
            border-bottom: 2px solid #2964F2;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }
        .company-title {
            font-size: 18px;
            font-weight: bold;
            color: #0f172a;
            letter-spacing: -0.3px;
            margin: 0;
        }
        .company-sub {
            font-size: 9.5px;
            color: #64748b;
            margin: 2px 0 0 0;
        }
        .app-code-badge {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 6px 12px;
            text-align: right;
            border-radius: 6px;
        }
        .app-code-title {
            font-size: 8.5px;
            text-transform: uppercase;
            font-weight: bold;
            color: #1d4ed8;
            letter-spacing: 0.5px;
        }
        .app-code-val {
            font-size: 13px;
            font-weight: bold;
            color: #1e40af;
            letter-spacing: 0.5px;
            margin-top: 2px;
        }
        .section-header {
            background-color: #f8fafc;
            border-left: 3.5px solid #2964F2;
            padding: 5px 8px;
            font-size: 10.5px;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-top: 12px;
            margin-bottom: 6px;
        }
        .data-table {
            width: 100%;
            margin-bottom: 8px;
            border: 1px solid #e2e8f0;
        }
        .data-table td {
            padding: 5px 8px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
            font-size: 10px;
        }
        .data-table tr:nth-child(even) {
            background-color: #fafafa;
        }
        .label-col {
            width: 28%;
            font-weight: bold;
            color: #475569;
            background-color: #f8fafc;
            border-right: 1px solid #e2e8f0;
        }
        .val-col {
            width: 72%;
            color: #0f172a;
        }
        .role-pill {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 9.5px;
            color: #ffffff;
            background-color: {{ $partner->registration_type === 'GP' ? '#d97706' : '#2964F2' }};
        }
        .status-pill {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 9px;
            color: #92400e;
            background-color: #fef3c7;
            border: 1px solid #fde68a;
        }
        .declaration-item {
            margin-bottom: 4px;
            padding: 4.5px 7px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
        }
        .dec-check {
            color: #16a34a;
            font-weight: bold;
            font-size: 10px;
            display: inline-block;
            margin-right: 4px;
        }
        .dec-text {
            font-size: 9.5px;
            color: #334155;
            line-height: 1.35;
        }
        .audit-box {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 6px;
            padding: 8px 10px;
            margin-top: 10px;
        }
        .audit-title {
            font-size: 9.5px;
            font-weight: bold;
            color: #166534;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .footer-note {
            margin-top: 14px;
            padding-top: 8px;
            border-top: 1px dashed #cbd5e1;
            font-size: 8.5px;
            color: #64748b;
            text-align: center;
            line-height: 1.35;
        }
        .stamp-table {
            margin-top: 12px;
            width: 100%;
        }
        .stamp-box {
            border: 1px dashed #94a3b8;
            padding: 10px;
            text-align: center;
            border-radius: 4px;
            background-color: #f8fafc;
        }
    </style>
</head>
<body>
@php
    $appDate = ($partner->created_at instanceof \Carbon\CarbonInterface)
        ? $partner->created_at->timezone('Asia/Kolkata')->format('d F Y, h:i:s A')
        : now('Asia/Kolkata')->format('d F Y, h:i:s A');

    $acceptedDate = (optional($partner->termsCheck)->accepted_at instanceof \Carbon\CarbonInterface)
        ? $partner->termsCheck->accepted_at->timezone('Asia/Kolkata')->format('d M Y, h:i:s A')
        : $appDate;

    $declDate = ($partner->created_at instanceof \Carbon\CarbonInterface)
        ? $partner->created_at->timezone('Asia/Kolkata')->format('d/m/Y')
        : date('d/m/Y');
@endphp

    <!-- Header Table -->
    <table class="header-table">
        <tr>
            <td style="width: 60%; vertical-align: top;">
                <h1 class="company-title">SUMATRA SALES PRIVATE LIMITED</h1>
                <p class="company-sub">CIN: U51909WB2020PTC237800 | ISO 9001:2015 Certified</p>
                <p class="company-sub">Web: sumatrasales.com | Helpdesk: partner@sumatrasales.com</p>
                <p style="margin: 4px 0 0 0; font-size: 11px; font-weight: bold; color: #2964F2;">
                    OFFICIAL PARTNER APPLICATION & STATUTORY TERMS RECORD
                </p>
            </td>
            <td style="width: 40%; vertical-align: top; text-align: right;">
                <div class="app-code-badge">
                    <div class="app-code-title">Application Reference Code</div>
                    <div class="app-code-val">{{ $partner->application_code }}</div>
                    <div style="margin-top: 4px;">
                        <span class="status-pill">&#9679; Pending Verification</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- 1. Application & Role Overview -->
    <div class="section-header">1. Application Overview</div>
    <table class="data-table">
        <tr>
            <td class="label-col">Application Code</td>
            <td class="val-col" style="font-weight: bold; font-family: monospace;">{{ $partner->application_code }}</td>
        </tr>
        <tr>
            <td class="label-col">Applied Position</td>
            <td class="val-col">
                <span class="role-pill">
                    {{ $partner->registration_type === 'GP' ? 'Ground Partner (GP)' : 'Executive Partner (EP)' }}
                </span>
                <span style="font-size: 9px; color: #64748b; margin-left: 6px;">
                    ({{ $partner->registration_type === 'GP' ? 'Commission-Only Basis under Schedule A' : 'Fixed Monthly Amount + Commission under Schedule B' }})
                </span>
            </td>
        </tr>
        <tr>
            <td class="label-col">Application Date & Time</td>
            <td class="val-col">
                {{ $appDate }} IST
            </td>
        </tr>
        <tr>
            <td class="label-col">Current Status</td>
            <td class="val-col">
                <strong>Pending Verification & Review</strong> (Partner code GP-XXXXXXXX / EP-XXXXXXXX to be issued upon document approval)
            </td>
        </tr>
    </table>

    <!-- 2. Applicant Profile & Communication Details -->
    <div class="section-header">2. Applicant Personal & Communication Profile</div>
    <table class="data-table">
        <tr>
            <td class="label-col">Full Legal Name</td>
            <td class="val-col" style="font-weight: bold; font-size: 10.5px;">{{ $partner->name }}</td>
        </tr>
        <tr>
            <td class="label-col">Registered Mobile Number</td>
            <td class="val-col"><strong>+91 {{ $partner->phone }}</strong> (OTP Verified)</td>
        </tr>
        <tr>
            <td class="label-col">Registered Email Address</td>
            <td class="val-col"><strong>{{ $partner->email }}</strong></td>
        </tr>
        <tr>
            <td class="label-col">Residential Address</td>
            <td class="val-col">
                {{ $partner->address ? $partner->address . ', ' : '' }}
                {{ $partner->city ? $partner->city . ', ' : '' }}
                {{ $partner->district ? $partner->district . ', ' : '' }}
                {{ $partner->state ?? '' }} - {{ $partner->pincode ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="label-col">Selected Working Projects</td>
            <td class="val-col">
                @if (!empty($partner->interests) && is_array($partner->interests))
                    <strong>{{ implode(', ', $partner->interests) }}</strong>
                @else
                    <span style="color: #64748b;">Not specified</span>
                @endif
            </td>
        </tr>
    </table>

    <!-- 3. Official Identity Credentials & Bank Payout Details -->
    <div class="section-header">3. Official Identity Credentials & Direct Bank Settlement</div>
    <table class="data-table">
        <tr>
            <td class="label-col">Aadhaar Card Number</td>
            <td class="val-col">
                @php
                    $aNum = $partner->aadhaar_number ?? '';
                    $maskedAadhaar = strlen($aNum) >= 4 ? str_repeat('X', max(0, strlen($aNum) - 4)) . substr($aNum, -4) : $aNum;
                @endphp
                <span style="font-family: monospace; font-weight: bold;">{{ $maskedAadhaar }}</span>
                <span style="font-size: 8.5px; color: #64748b; margin-left: 6px;">(Masked for Data Protection & UIDAI Compliance)</span>
            </td>
        </tr>
        <tr>
            <td class="label-col">Income Tax PAN Number</td>
            <td class="val-col" style="font-family: monospace; font-weight: bold;">
                {{ strtoupper($partner->pancard_number ?? '-') }}
            </td>
        </tr>
        <tr>
            <td class="label-col">Settlement Bank Name</td>
            <td class="val-col"><strong>{{ $partner->bank_name ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td class="label-col">Bank Account Number</td>
            <td class="val-col" style="font-family: monospace;">
                @php
                    $bAcc = $partner->bank_account_number ?? '';
                    $maskedAcc = strlen($bAcc) >= 4 ? str_repeat('X', max(0, strlen($bAcc) - 4)) . substr($bAcc, -4) : $bAcc;
                @endphp
                {{ $maskedAcc }}
            </td>
        </tr>
        <tr>
            <td class="label-col">Bank IFSC Code</td>
            <td class="val-col" style="font-family: monospace; font-weight: bold;">
                {{ strtoupper($partner->ifsc_code ?? '-') }}
            </td>
        </tr>
    </table>

    <!-- 4. Statutory Declarations & Electronic Contract Terms -->
    <div class="section-header">4. Statutory Declarations Confirmed by Applicant</div>
    <div style="margin-bottom: 8px;">
        @if ($partner->termsCheck && is_array($partner->termsCheck->terms_and_condition))
            @foreach ($partner->termsCheck->terms_and_condition as $term)
                <div class="declaration-item">
                    <span class="dec-check">&#10004; [CONFIRMED]</span>
                    <strong style="font-size: 9px; color: #1e40af;">[{{ $term['code'] ?? 'DEC' }}]</strong>
                    <span class="dec-text">{{ $term['text'] ?? '' }}</span>
                </div>
            @endforeach
        @else
            <div class="declaration-item">
                <span class="dec-check">&#10004; [CONFIRMED]</span>
                <span class="dec-text">All Common Statutory Declarations and Role Declarations for {{ $partner->registration_type === 'GP' ? 'Ground Partner (GP)' : 'Executive Partner (EP)' }} accepted.</span>
            </div>
        @endif
    </div>

    <!-- 5. Electronic Audit Trail Box (IT Act 2000 Section 10A) -->
    <div class="audit-box">
        <div class="audit-title">&#128274; Electronic Signature & Audit Trail (IT Act, 2000 Section 10A)</div>
        <table style="width: 100%; font-size: 9px;">
            <tr>
                <td style="width: 50%; padding: 2px 0;">
                    <strong>Terms Version Accepted:</strong> {{ $partner->termsCheck->terms_version ?? 'Version 2.0' }}
                </td>
                <td style="width: 50%; padding: 2px 0;">
                    <strong>IST Timestamp:</strong> {{ $acceptedDate }} IST
                </td>
            </tr>
            <tr>
                <td style="width: 50%; padding: 2px 0;">
                    <strong>Client IP Address:</strong> {{ $partner->termsCheck->ip_address ?? 'Captured Electronically' }}
                </td>
                <td style="width: 50%; padding: 2px 0;">
                    <strong>Authentication Method:</strong> Mobile OTP Verification & Digital Checksum
                </td>
            </tr>
        </table>
    </div>

    <!-- Official Stamp & Disclaimer Signatures -->
    <table class="stamp-table">
        <tr>
            <td style="width: 50%; padding-right: 8px;">
                <div class="stamp-box">
                    <div style="font-size: 9px; font-weight: bold; color: #475569;">APPLICANT DECLARATION</div>
                    <div style="margin-top: 18px; font-size: 8.5px; color: #1e293b; font-weight: bold;">
                        Digitally Accepted by: {{ $partner->name }}
                    </div>
                    <div style="font-size: 8px; color: #64748b;">
                        Date: {{ $declDate }}
                    </div>
                </div>
            </td>
            <td style="width: 50%; padding-left: 8px;">
                <div class="stamp-box">
                    <div style="font-size: 9px; font-weight: bold; color: #1e40af;">SUMATRA SALES PRIVATE LIMITED</div>
                    <div style="margin-top: 18px; font-size: 8.5px; color: #1e293b; font-weight: bold;">
                        Partner Verification Desk
                    </div>
                    <div style="font-size: 8px; color: #64748b;">
                        CIN: U51909WB2020PTC237800
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer-note">
        This document is an electronically generated Partner Application Acknowledgement and Statutory Terms Record under Section 10A of the Information Technology Act, 2000. No physical signature is required. For verification or support inquiries, contact <strong>partner@sumatrasales.com</strong>.<br>
        &copy; {{ date('Y') }} Sumatra Sales Private Limited. All rights reserved.
    </div>

</body>
</html>
