
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login | Shuisi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Tailwind Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        
       @vite('/resources/css/app.css')
        <link rel="shortcut icon" href="./assets/images/logo.png">
        
        
      <link rel="stylesheet" href="./assets/css/tailwind2.css">
    </head>

    <body class="flex items-center justify-center min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('assets/images/img-7.jpeg');">
    <div class="w-full max-w-sm bg-white p-6 bg-opacity-50 rounded-lg shadow-lg backdrop-blur-md">
        <div class="text-center">
            <img src="assets/images/logo.png" alt="" class="w-40 h-40 mx-auto ltr:xl:mr-4 rtl:xl:ml-2">
            <h2 class="mt-4 text-xl font-semibold text-black-800">Shuisi</h2>
        </div>

        <form class="mt-6" action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-black-700">Nama</label>
                <input name="nama" type="text" class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-violet-500 focus:outline-none" placeholder="Enter Nama">
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-black-700">Password</label>
                <input name="password" type="password" class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-violet-500 focus:outline-none" placeholder="Enter password">
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-sm text-black-700">
                    <input type="checkbox" class="w-4 h-4 mr-2 text-violet-500 focus:ring-violet-400">
                    Remember me
                </label>
                <a href="#" class="text-sm text-yellow-500 hover:underline">Forgot password?</a>
            </div>

            <button type="submit" class="w-full py-2 text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">Log In</button>
        </form>


        <div id="Modalloaded" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
                <p id="loadtext" class=" text-lg text-gray-700"></p>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">Don't have an account? <a href="register.html" class="text-violet-500 font-semibold hover:underline">Signup now</a></p>
        </div>
    </div>
  </body>
<script>
    const text= "Mohon Tunggu...";
    const loadtext = document.getElementById("loadtext");

    function animate() {
        loadtext.innerHTML = "";
        let index = 0;

        const showinterfal = setInterval(() => {
            if (index < text.length) {
                loadtext.innerHTML +=text[index];
                index++;
            } else {
                clearInterval(showinterfal);

                setTimeout(() => {
                    let hidetext = text.length;
                    const hideinterval = setInterval(() => {
                        if (hidetext > 0) {
                            loadtext.innerHTML = text.substring(0, hidetext - 1);
                            hidetext--;
                        } else{
                            clearInterval(hideinterval);
                            setTimeout(animate, 250);
                        }
                    },50);
                }, 250);
            }
        }, 50);
    }
    function showlogin() 
    {
        document.getElementById("Modalloaded").classList.remove("hidden");
        animate();
    }
    function hidelogin() {
        document.getElementById("Modalloaded").classList.add("hidden");
    }

    function cihuy() {
        showlogin();
    }

    document.addEventListener("DOMContentLoaded", function () {
        let form = document.querySelector("form");
        if (form) {
            form.addEventListener("submit", function () {
                showlogin();
            });
        }
    });
    
</script>
</html>