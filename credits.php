<?php
require_once ("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Credits</title>
    <link rel="stylesheet" type="text/css" href="Assignment2019.css">
</head>
<body>

<?php
display_nav();

if (isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true) {
    echo "<form id='logout' method='post' action='logout.php'>
    <input type='submit' value='Logout' />
</form>"; } else {
    echo "<div class='logon'>
        <form method='post' action='loginProcess.php'>
            Username <input type='text' name='username' />
            Password <input type='password' name='password' />
            <input type='submit' value='Logon' />
        </form>
    </div>"; };
?>
<h1>Credits</h1>
<p>Created by: Sean Pattinson (16004894). </p>
<br/>
<h2>References</h2>
<div>Unn-cgdh2.newnumyspace.co.uk. Javascript Tutor 1: Basics. [online] Available at: <a href="http://unn-cgdh2.newnumyspace.co.uk/JSTutors/01%20Javascript%20Basics/index.html">http://unn-cgdh2.newnumyspace.co.uk/JSTutors/01%20Javascript%20Basics/index.html</a>[Accessed 18th Nov. 2018].
<br/>
    Unn-cgdh2.newnumyspace.co.uk. Javascript Tutor 1: Functions. [online] Available at:  <a href="http://unn-cgdh2.newnumyspace.co.uk/JSTutors/02%20Javascript%20Functions/index.html">http://unn-cgdh2.newnumyspace.co.uk/JSTutors/02%20Javascript%20Functions/index.html</a> [Accessed 20th Nov. 2018].
<br/>
    Unn-cgdh2.newnumyspace.co.uk. Javascript Tutor 3: Events. [online] Available at: <a href="http://unn-cgdh2.newnumyspace.co.uk/JSTutors/03%20Javascript%20Events/index.html">http://unn-cgdh2.newnumyspace.co.uk/JSTutors/03%20Javascript%20Events/index.html</a> [Accessed 27th Nov. 2018].
<br/>
    Unn-cgdh2.newnumyspace.co.uk. Javascript Tutor 4: Forms. [online] Available at: <a href="http://unn-cgdh2.newnumyspace.co.uk/JSTutors/04%20Javascript%20and%20Forms/index.html">http://unn-cgdh2.newnumyspace.co.uk/JSTutors/04%20Javascript%20and%20Forms/index.html</a> [Accessed 28 Nov. 2018].
<br/>
    Unn-cgdh2.newnumyspace.co.uk. Javascript Tutor 5: DOM. [online] Available at: <a href="http://unn-cgdh2.newnumyspace.co.uk/JSTutors/05%20Javascript%20and%20the%20DOM/index.html">http://unn-cgdh2.newnumyspace.co.uk/JSTutors/05%20Javascript%20and%20the%20DOM/index.html</a> [Accessed 10 Dec. 2018].
<br/>
    Unn-cgdh2.newnumyspace.co.uk. Javascript Tutor 6: Style. [online] Available at: <a href="http://unn-cgdh2.newnumyspace.co.uk/JSTutors/06%20Javascript%20and%20DOM%20Style/index.html">http://unn-cgdh2.newnumyspace.co.uk/JSTutors/06%20Javascript%20and%20DOM%20Style/index.html</a> [Accessed 15 Dec. 2018].
</div>
</body>
</html>
