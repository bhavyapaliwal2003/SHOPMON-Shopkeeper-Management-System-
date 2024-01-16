<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power BI Report Embedding</title>

    <!-- Include Power BI JavaScript library -->
    <script src="https://app.powerbi.com/scripts/reportembed.min.js"></script>
    <!-- Include jQuery (uncomment if needed) -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>

    <!-- Container for the embedded Power BI report -->
    <div id="embedContainer"></div>

    <script>
        // Your JavaScript code
        let loadedResolve, reportLoaded = new Promise((res, rej) => { loadedResolve = res; });
        let renderedResolve, reportRendered = new Promise((res, rej) => { renderedResolve = res; });

        // Embed a Power BI report
        function embedPowerBIReport() {
            // Replace placeholder values with your actual values
            let accessToken = 'EMBED_ACCESS_TOKEN';
            let embedUrl = 'EMBED_URL';
            let embedReportId = 'REPORT_ID';
            let tokenType = 'TOKEN_TYPE';

            // We give All permissions to demonstrate switching between View and Edit mode and saving report.
            let permissions = window['powerbi-client'].models.Permissions.All;

            // Create the embed configuration object for the report
            let config = {
                type: 'report',
                tokenType: tokenType == '0' ? window['powerbi-client'].models.TokenType.Aad : window['powerbi-client'].models.TokenType.Embed,
                accessToken: accessToken,
                embedUrl: embedUrl,
                id: embedReportId,
                permissions: permissions,
                settings: {
                    panes: {
                        filters: {
                            visible: true
                        },
                        pageNavigation: {
                            visible: true
                        }
                    },
                    bars: {
                        statusBar: {
                            visible: true
                        }
                    }
                }
            };

            // Get a reference to the embedded report HTML element
            let embedContainer = document.getElementById('embedContainer');

            // Embed the report and display it within the div container.
            let report = window['powerbi-client'].embed(embedContainer, config);

            // Event handlers
            report.off("loaded");
            report.on("loaded", function () {
                loadedResolve();
                report.off("loaded");
            });

            report.off("error");
            report.on("error", function (event) {
                console.log(event.detail);
            });

            report.off("rendered");
            report.on("rendered", function () {
                renderedResolve();
                report.off("rendered");
            });
        }

        // Call the function to embed the report
        embedPowerBIReport().then(() => {
            // Insert your code here to run after the report is loaded
            report.fullscreen();
        }).then(() => {
            // Insert your code here to run after the report is rendered
        });
    </script>
</body>

</html>
