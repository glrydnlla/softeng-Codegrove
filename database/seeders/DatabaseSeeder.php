<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programming_languages')->insert([
            ['programming_language_name' => 'C', 'programming_language_image_path' => 'c.png', 'created_at' => Carbon::now()->subSeconds(2200)],
            ['programming_language_name' => 'Java', 'programming_language_image_path' => 'java.png', 'created_at' => Carbon::now()->subSeconds(2200)],
            ['programming_language_name' => 'HTML', 'programming_language_image_path' => 'html.png', 'created_at' => Carbon::now()->subSeconds(2200)],
            ['programming_language_name' => 'JavaScript', 'programming_language_image_path' => 'js.png', 'created_at' => Carbon::now()->subSeconds(2200)],
            ['programming_language_name' => 'Python', 'programming_language_image_path' => 'py.png', 'created_at' => Carbon::now()->subSeconds(2200)],
        ]);

        DB::table('users')->insert([
            ['username' => 'test', 'email' => 'test@gmail.com', 'password' => bcrypt('Test123!'), 'dob' => '2002-02-22', 'role' => 'user', 'display_picture_path' => 'gg--profile.png', 'created_at' => Carbon::now()->subSeconds(190)],
            ['username' => 'glory', 'email' => 'glory@gmail.com', 'password' => bcrypt('Glory123!'), 'dob' => '2002-02-22', 'role' => 'user', 'display_picture_path' => 'gg--profile.png', 'created_at' => Carbon::now()->subSeconds(190)],
            ['username' => 'admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('Admin123!'), 'dob' => '2002-02-22', 'role' => 'admin', 'display_picture_path' => 'gg--profile.png', 'created_at' => Carbon::now()->subSeconds(190)],
        ]);

        DB::table('subscriptions')->insert([
            ['subscription_name' => 'Basic', 'subscription_description' => '10 questions per week', 'subscription_price' => 10000],
            ['subscription_name' => 'Premium', 'subscription_description' => '50 questions per week', 'subscription_price' => 40000],
            ['subscription_name' => 'Diamond', 'subscription_description' => '100 questions per week', 'subscription_price' => 80000],
            ['subscription_name' => 'Infinite', 'subscription_description' => 'Unlimited amount of questions', 'subscription_price' => 500000]
        ]);

        DB::table('posts')->insert([
            ['user_id' => 1, 'programming_language_id' => 1, 'post_id' => NULL, 'post_content' => 'Explain the difference between int and float data types in C.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(11180)],
            ['user_id' => 1, 'programming_language_id' => 1, 'post_id' => NULL, 'post_content' => 'What is the purpose of the main function in a C program?', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(11170)],
            ['user_id' => 1, 'programming_language_id' => 1, 'post_id' => NULL, 'post_content' => 'How do you declare and define a function in C?', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(11160)],
            ['user_id' => 1, 'programming_language_id' => 1, 'post_id' => NULL, 'post_content' => 'Explain the difference between call by value and call by reference in C functions.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(11150)],
            ['user_id' => 1, 'programming_language_id' => 1, 'post_id' => NULL, 'post_content' => 'What is a pointer in C? How do you declare and use pointers?', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(11140)],
            ['user_id' => 1, 'programming_language_id' => 1, 'post_id' => NULL, 'post_content' => 'What is the malloc function in C? How is it used for dynamic memory allocation?', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(11130)],
            ['user_id' => 1, 'programming_language_id' => 1, 'post_id' => NULL, 'post_content' => 'Explain the concept of arrays in C. How do you declare and access elements of an array?', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(11120)],
            ['user_id' => 1, 'programming_language_id' => 1, 'post_id' => NULL, 'post_content' => 'Describe the difference between printf and scanf functions in C.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(11110)],
            ['user_id' => 1, 'programming_language_id' => 1, 'post_id' => NULL, 'post_content' => 'What are conditional statements in C? Provide examples of if, if-else, and switch statements.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(11100)],
            ['user_id' => 2, 'programming_language_id' => 1, 'post_id' => 1, 'post_content' => 'In C, the int data type is used for integers, representing whole numbers, while the float data type is used for floating-point numbers, representing numbers with decimal points.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1190)],
            ['user_id' => 2, 'programming_language_id' => 1, 'post_id' => 2, 'post_content' => 'The main function serves as the entry point for a C program, where program execution begins. It typically contains the code that performs the primary functionality of the program.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1180)],
            ['user_id' => 2, 'programming_language_id' => 1, 'post_id' => 3, 'post_content' => 'In C, a function is declared by specifying its return type, name, and parameters. The declaration provides the function\'s signature, allowing it to be called from other parts of the program. The function is then defined by providing the implementation of its code within curly braces.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1170)],
            ['user_id' => 2, 'programming_language_id' => 1, 'post_id' => 4, 'post_content' => 'Call by value and call by reference are two methods of passing arguments to functions in C. Call by value involves passing copies of the argument values to the function, ensuring that changes made to the parameters within the function do not affect the original values. Call by reference, on the other hand, passes the memory addresses of the arguments, allowing changes made to the parameters to affect the original values.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1160)],
            ['user_id' => 2, 'programming_language_id' => 1, 'post_id' => 5, 'post_content' => 'In C, a pointer is a variable that stores the memory address of another variable. Pointers are widely used for dynamic memory allocation, accessing array elements, and implementing data structures like linked lists and trees.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1150)],
            ['user_id' => 2, 'programming_language_id' => 1, 'post_id' => 6, 'post_content' => 'The malloc function in C is used for dynamic memory allocation. It allocates a block of memory of the specified size during program execution and returns a pointer to the first byte of the allocated memory.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1140)],
            ['user_id' => 2, 'programming_language_id' => 1, 'post_id' => 7, 'post_content' => 'Arrays in C are collections of elements of the same data type stored in contiguous memory locations. They provide a convenient way to store and access multiple values of the same type using a single variable name.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1130)],
            ['user_id' => 2, 'programming_language_id' => 1, 'post_id' => 8, 'post_content' => 'The printf function in C is used to print formatted output to the console. It accepts format specifiers to control the formatting of the output. In contrast, the scanf function is used to read input from the user, formatted according to specified format specifiers.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1120)],
            ['user_id' => 2, 'programming_language_id' => 1, 'post_id' => 9, 'post_content' => 'Conditional statements in C, such as if, if-else, and switch, are used to control the flow of program execution based on specified conditions. The if statement executes a block of code if a condition is true, while the if-else statement allows for the execution of different blocks of code based on whether the condition is true or false. The switch statement executes different blocks of code based on the value of an expression.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1110)],
            ['user_id' => 2, 'programming_language_id' => 3, 'post_id' => NULL, 'post_content' => 'What is the purpose of the <div> element in HTML?', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1109)],
            ['user_id' => 1, 'programming_language_id' => 3, 'post_id' => 19, 'post_content' => 'The <div> element is used as a container to group and style content in HTML.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1108)],
            ['user_id' => 2, 'programming_language_id' => 2, 'post_id' => NULL, 'post_content' => 'How do you define a class in Java?', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1109)],
            ['user_id' => 1, 'programming_language_id' => 2, 'post_id' => 21, 'post_content' => 'You define a class in Java using the class keyword followed by the class name and a pair of curly braces.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1108)],
            ['user_id' => 1, 'programming_language_id' => 4, 'post_id' => NULL, 'post_content' => 'How can you declare a variable in JavaScript?', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1107)],
            ['user_id' => 2, 'programming_language_id' => 4, 'post_id' => 23, 'post_content' => 'You can declare a variable in JavaScript using the var, let, or const keywords', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1106)],
            ['user_id' => 2, 'programming_language_id' => 5, 'post_id' => NULL, 'post_content' => 'How do you create a list in Python?', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1105)],
            ['user_id' => 1, 'programming_language_id' => 5, 'post_id' => 25, 'post_content' => 'You can create a list in Python by placing comma-separated values inside square brackets.', 'status' => 'active', 'created_at' => Carbon::now()->subSeconds(1104)],
        ]);
    }
}
