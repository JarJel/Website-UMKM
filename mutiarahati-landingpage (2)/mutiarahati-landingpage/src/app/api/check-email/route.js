import { checkAllowedEmail } from "@/utils/googleSheets";

export async function POST(req) {
  const { email } = await req.json();

  if (!email) {
    return new Response(JSON.stringify({ allowed: false }), { status: 400 });
  }

  const allowed = await checkAllowedEmail(email);
  return new Response(JSON.stringify({ allowed }), { status: 200 });
}
