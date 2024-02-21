<!DOCTYPE html>
<html xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Scripture Emailer</title>
    <style>
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        table.wrapper {
            width: 100% !important;
            table-layout: fixed;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -moz-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        .convener {
            border-right: 1px solid #dd3c34;
        }

        .xs-visible {
            display: none !important;
        }

        /*Responsive*/
        @media screen and (max-width:601px) {
            .md-hidden {
                display: none
            }

            .convener {
                border-right: 1px solid transparent !important;
            }
        }

        @media screen and (max-width:500px) {

            .convener {
                border-right: 1px solid transparent !important;
            }

            .columns {
                width: 100% !important;
            }

            .column {
                display: block !important;
                width: 100% !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            .column-2 {
                display: inline-block !important;
                width: 100% !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                margin-bottom: 0px
            }

            .venue-div .date,
            .venue-div .venue {
                display: block
            }

            .font-24 {
                font-size: 24px !important
            }

            .font-16 {
                font-size: 16px !important
            }

            .p-lr-xs-0 {
                padding: 0px !important;
            }

            .p-lr-xs-15 {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            .xs-hidden {
                display: none !important
            }

            .xs-visible {
                display: block !important;
            }

            .w-0 {
                width: 0% !important
            }

            .w-5 {
                width: 5% !important
            }

            .w-50 {
                width: 50% !important
            }

            .w-40 {
                width: 40% !important
            }

            .max-width {
                width: 100%;
                height: auto
            }

            table.cases-table {
                border: 0px !important
            }

            table.cases-table>tbody>tr {
                width: 100% !important;
                display: flex;
                flex-wrap: wrap;
                border: 1px solid #cccccc;
                margin-bottom: 10px
            }

            table.cases-table>tbody>tr>td {
                width: 100% !important;
                display: table;
                border-top: 0px solid red !important;
                border-right: 0px solid red !important;
                border-left: 0px solid red !important;
            }

            table.cases-table>tbody>tr:last-child>td {
                /*                border-bottom: 0px !important*/
            }

            table.cases-table>tbody>tr>td.xs-hidden {
                display: none !important
            }

            table.cases-table>tbody>tr>td.xs-visible {
                display: block !important;
            }

            table.cases-table>tbody>tr>td>span {
                width: 80px;
                display: table-cell;
                padding: 3px;
                font-weight: 600
            }

            table.cases-table>tbody>tr>td:last-child {
                border-bottom: 0 !important
            }

            /*Convener Table*/
            table.convener-table {
                border: 1px solid #00A7DC !important
            }

            table.convener-table>tbody>tr {
                width: 100% !important;
                display: block;
            }

            table.convener-table>tbody>tr>td {
                display: block !important;
                width: 100% !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                border-top: 0px solid red !important;
                border-right: 0px solid red !important;
                border-left: 0px solid red !important;
            }

            table.convener-table>tbody>tr>td:first-child {
                border: 0px solid #fff !important;
                padding-bottom: 0px !important
            }

            table.convener-table>tbody>tr:last-child>td {
                border-bottom: 0px solid #fff !important
            }

            table.convener-table>tbody>tr>td span,
            table.convener-table>tbody>tr>td b {
                padding: 0 10px !important;
                display: block
            }

            table.convener-table>tbody>tr>td.xs-hidden {
                display: none !important
            }

            .cases-table tbody td:before {
                content: attr(data-label);
                float: left;
                font-size: 10px;
                /* text-transform: uppercase; */
                font-weight: bold;
            }

            .cases-table tbody td {
                display: block;
                text-align: right;

            }


        }
    </style>

</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <table class="fallback-text wrapper" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family: Arial;">
        <tr>
            <td width="100%" style="font-size: 12px;max-width: 650px">

                <table class="fallback-text" width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family: Arial;color: rgb(83, 81, 81); max-width:650px;font-size: 13px;border: 1px solid #eee;">

                    <tr>
                        <td colspan="5" style="padding: 0px" bgcolor="#ffffff">
                            <img src="https://cminds.in/SCRIPTURE/Emailer/Emailer-1/images/banner.jpg" style="max-width: 650px;padding: 0px;margin: 0">
                        </td>
                    </tr>


                    <tr>
                        <td colspan="5" style="padding:30px 40px 40px;" bgcolor="#ffffff">
                            <table class="fallback-text" width="100%" cellspacing="0" cellpadding="0" style="font-family: system-ui;color: #000221; max-width:650px;font-size: 14.3px;padding:0 15px;font-weight:500" border="0">

                                <tr>

                                    <td align="left">

                                        <p>Dear <?= $name ?>,</p>

                                        <p><b>Action Required: Click on below link to reset password</b></p>
                                        <p>Please click on the following link to reset password:</p>
                                        <p><a clicktracking=off href="<?= $link; ?>" target="_blank"><?= $link; ?></a></p>
                                        <p>If the link above does not work, you can copy and paste the following URL into your browser:</p>
                                        <p><a clicktracking=off href="<?= $link; ?>" target="_blank"><?= $link; ?></a></p>

                                        <p><b>Troubleshooting:</b></p>
                                        <p>If you encounter any issues or have questions, please contact our support team at <a clicktracking=off href="mailto:support@scripturesubmission.com" target="_blank">support@scripturesubmission.com</a> </p>
                                        <p>Thank you for Choosing Scripture!</p>
                                        <p>We look forward to having you as an active member of our community. Your participation is valuable, and we can't wait to see the contributions you'll make.</p>


                                        <p style="margin-top: 28px;">Best regards,</p>
                                        <p style="margin-top: -7px"><b>Your Scripture Team</b></p>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5" align="center" bgcolor="#143e99" style="padding: 0px">
                            <table class="fallback-text" width="100%" cellspacing="0" cellpadding="0" style="font-family: system-ui;color: #ffffff; max-width:650px;font-size: 11px;padding:0 15px;" border="0">

                                <tr>
                                    <td>
                                        <table class="fallback-text" style="font-family: Arial;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="column-2" style="padding: 10px" valign="top" align="center" width="5%"></td>
                                                    <td class="column-2" style="padding: 10px" valign="top" align="center" width="90%">
                                                        <table class="fallback-text" style="font-family: system-ui;color: #FFFFFF;font-size: 13px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                            <tbody>


                                                                <tr>
                                                                    <td align="center" valign="top" style="color: #ffffff;font-size: 18px;">
                                                                        <b>Address</b>
                                                                    </td>
                                                                </tr>


                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td class="column-2" style="padding: 10px" valign="top" align="center" width="5%"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>
</body>

</html>