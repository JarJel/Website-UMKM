<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./output.css" rel="stylesheet" />
    <title>Sign Up</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-poppins bg-white min-h-screen">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white border-b-2 border-black shadow-lg rounded-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="w-[175px] h-[100px]">
                    <img src="../../../assets/imageInternal/logoBatara.png" class="w-full h-full object-contain">
                </div>
                <div class="relative inline-block group">
                    <button
                    class="flex items-center justify-center space-x-2 text-white bg-[#42551E] px-4 py-2 rounded-lg hover:bg-[#5b7028] transition">
                    <span>Sign in</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>


    <!-- Login Form Container -->
    <div class="flex justify-center items-center shadow-lg py-16">
      <div
        class="bg-[#42551E] rounded-2xl shadow-lg p-8 max-w-md w-full">
        <h1 class="pb-6 font-bold text-gray-100 text-3xl text-center cursor-default">
          Sign Up
        </h1>
        <form action="#" method="post" class="space-y-4">
          <div>
            <label for="email" class="block mb-1 text-gray-200 text-base">Email</label>
            <input
              id="email"
              class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
              type="email"
              placeholder="Email"
              required
            />
          </div>
          <div>
            <label for="username" class="block mb-1 text-gray-200 text-base">Username</label>
            <input
              id="username"
              class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
              type="username"
              placeholder="Username"
              required
            />
          </div>
          <div>
            <label for="password" class="block mb-1 text-gray-200 text-base">Password</label>
            <input
              id="password"
              class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
              type="password"
              placeholder="Password"
              required
            />
          </div>
          <div class="flex items-center space-x-2">
            <input 
              id="agree" 
              type="checkbox" 
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
            >
            <label for="agree" class="text-sm text-white">
              I agree with <a href="#" class="text-blue-600 underline">Privacy and Policy</a>
            </label>
          </div>
          <button
            class="bg-white shadow-lg mt-4 p-2 text-[#42551E] rounded-lg w-full hover:scale-105 hover:from-purple-500 hover:to-blue-500 transition duration-300 ease-in-out"
            type="submit"
          >
            Sign Up
          </button>
          <!-- Divider -->
          <div class="flex items-center my-4">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="mx-2 text-gray-200 text-sm">or</span>
            <div class="flex-grow border-t border-gray-300"></div>
          </div>

          <!-- Login with Google -->
          <button
            type="button"
            class="flex items-center justify-center gap-2 bg-white text-gray-700 font-medium shadow-md border border-gray-300 rounded-lg py-2 px-4 w-full hover:bg-gray-100 transition"
          >
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Logo" class="w-5 h-5">
            Sign up with Google
          </button>
        </form>
        <div class="flex flex-col mt-4 items-center justify-center text-sm">
          <h3 class="text-gray-200">
            Already have an account?
            <a
              class="text-blue-300 hover:underline"
              href="#"
            >Sign In</a>
          </h3>
        </div>
      </div>
    </div>

  </body>
</html>
