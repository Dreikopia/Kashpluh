<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<section class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div class="flex items-center flex-col">
                    <h1 class="text-xl font-bold leading-tight text-center tracking-tight text-gray-900 md:text-3xl dark:text-white">
                        Log in
                    </h1>
                </div>

                <form class="space-y-4 md:space-y-6" action="/login" method="POST">
                    <div>
                        <label for="login" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username or login</label>
                        <input type="text" name="login" id="login" value="<?= old('login') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php if (isset($errors['login'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['login'] ?></p>
                        <?php endif ?>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php if (isset($errors['password'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['password'] ?></p>
                        <?php endif ?>
                    </div>
                    <?php if (isset($errors['credentials'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['credentials'] ?></p>
                    <?php endif ?>
                    <button type="submit" class="w-full text-white bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:outline-none focus:ring-amber-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-amber-500 dark:hover:bg-amber-400 dark:focus:ring-amber-500">
                        Log in
                    </button>

                    <div class="flex justify-center">
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Doesn't have an account? <a href="/register" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>