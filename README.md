# Slack API for FH Technikum Wien

An API to Push Notifications from the CIS of FH Technikum Wien to a desired Slack-Channel.
This Project is useful for students of FH Technikum Wien only. 

## Usage

in the "settings.php" add your CIS-Username, your CIS-Password, the CSV-Calender-URL, as well as the Webhook of your Slack-Channel (https://api.slack.com/incoming-webhooks). Then run the "index.php" and it will post if there are any lectures today. Works best if you create a cronjob for it.
