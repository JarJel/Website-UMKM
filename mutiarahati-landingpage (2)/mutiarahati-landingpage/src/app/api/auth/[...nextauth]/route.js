import NextAuth from "next-auth";
import GoogleProvider from "next-auth/providers/google";
import { checkAllowedEmail } from "@/utils/googleSheets";

export const authOptions = {
  providers: [
    GoogleProvider({
      clientId: process.env.GOOGLE_CLIENT_ID,
      clientSecret: process.env.GOOGLE_CLIENT_SECRET,
    }),
  ],
  callbacks: {
    async signIn({ user, account, profile }) {
      try {
        const isAllowed = await checkAllowedEmail(user.email);
        return isAllowed; // true jika ditemukan di sheet
      } catch (error) {
        console.error("Error saat cek email:", error);
        return false; // fallback kalau error
      }
    },
    async redirect({ url, baseUrl }) {
      // jika login sukses, arahkan ke /tk
      return baseUrl + "/tk";
    },
  },
  pages: {
    signIn: "/login",     // halaman login
    error: "/denied",     // kalau gagal login
  },
};

const handler = NextAuth(authOptions);
export { handler as GET, handler as POST };
