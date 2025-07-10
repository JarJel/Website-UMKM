import { google } from "googleapis";

const credentials = JSON.parse(
  Buffer.from(process.env.GOOGLE_CREDENTIALS_BASE64, "base64").toString("utf-8")
);

export async function checkAllowedEmail(email) {
  const auth = new google.auth.GoogleAuth({
    credentials,
    scopes: ["https://www.googleapis.com/auth/spreadsheets.readonly"],
  });

  const client = await auth.getClient();
  const sheets = google.sheets({ version: "v4", auth: client });

  const res = await sheets.spreadsheets.values.get({
    spreadsheetId: "1JjJuFhBDLZiJRRoSV1XGY5ho7a3d2QO1pARrsco46QU",
    range: "Sheet1!C2:C5",
  });

  const emails = res.data.values.flat();
  return emails.includes(email);
}
