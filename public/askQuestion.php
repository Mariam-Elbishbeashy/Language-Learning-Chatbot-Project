<?php 
include '../Language-Learning-Chatbot/controllers/askQuestionController.php';
require_once __DIR__ . '/../Language-Learning-Chatbot/model/forumModel.php';


$forumModel = new forumModel();
$topUsers = $forumModel->getTopUsers();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Ask online Form">
    <meta name="description" content="discussion forum website">
    <meta name="keywords" content="English, French, Spanish">
    <meta name="robots" content="index, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="../public/css/forum.css" rel="stylesheet" >
    <link href="../public/css/askQuestion.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../public/css/responsive.css" rel="stylesheet" type="text/css"> </head>
    
    <style>
    /* Style for the textarea */
    textarea#txtEditor {
        width: 100%;
        height: 300px; 
        padding: 15px;
        font-size: 16px;
        font-family: 'Arial', sans-serif;
        border-radius: 10px;
        border: 2px solid #ddd;
        background-color: #f4f4f9; 
        transition: border-color 0.3s ease, box-shadow 0.3s ease; 
        resize: none; 
    }

    textarea#txtEditor:focus {
        border-color: #fd6372; 
        box-shadow: 0 0 10px rgb(145, 55, 64); 
        outline: none; 
    }

    textarea#txtEditor::placeholder {
        font-style: italic;
        color: #aaa;
    }
</style>

<body>
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="navbar-serch-right-side">
                        <form class="navbar-form" role="search">
                            <div class="input-group add-on">
                                <input class="form-control form-control222" placeholder="Search" name="srch-term" id="srch-term" type="text">
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-default2913" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
               
                </div>
            </div>
        </div>
    </div>
    <div class="top-menu-bottom932">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand" href="#"><img src="./images/logo.png" alt="Logo"></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav"> </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../public/forum.php">Home</a></li>
                        <li><a href="../public/askQuestion.php">Ask Question</a></li>
                        <li><a href="../public/resources.php">Resources</a></li>
            </div>
        </nav>
    </div>
    <section class="header-descriptin329">
        <div class="container">
            <h3>Ask Question</h3>
            <ol class="breadcrumb breadcrumb839">
                <li><a href="#">Home</a></li>
                <li class="active">Ask Question</li>
            </ol>
        </div>
    </section>
    <section class="main-content920">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                <div class="ask-question-input-part032">
                      <h4>Ask Question</h4>
                 <hr>

                 <?php if (isset($_SESSION['errorMessage'])): ?>
    <div class="error"><?php echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['successMessage'])): ?>
    <div class="success"><?php echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); ?></div>
<?php endif; ?>
<form action="../Language-Learning-Chatbot/controllers/askQuestionController.php" method="POST" enctype="multipart/form-data">

    <div class="question-title39">
        <span class="form-description433">Question-Title* </span>
        <input type="text" name="title" class="question-ttile32" placeholder="Write Your Question Title" required>
    </div>
                    
    <div class="categori49">
        <span class="form-description43305">Category* </span>
        <label>
            <input list="browsers" name="category" class="list-category53" required>
        </label>
        <datalist id="browsers">
            <option value="English">
            <option value="French">
            <option value="Spanish">
        </datalist>
    </div>

    <div class="details2-239">
        <div class="col-md-12 nopadding">
            <textarea id="txtEditor" name="content" placeholder="Write your question details here..." required></textarea> 
        </div>
    </div>  
    <div class="publish-button2389">
                <button type="submit" name="publishQuestion" class="publis1291">Publish your Question</button>
            </div>
</form>

                </div>
                </div>
           <aside class="col-md-3 sidebar97239">
             <div class="categori-part329">
                 <h4>Category</h4>
                 <ul>
                     <li><a href="#">English</a></li>
                     <li><a href="#">French</a></li>
                     <li><a href="#">Spanish</a></li>
                 </ul>
             </div>
           
<!--              highest points-->
<div class="highest-part302">
    <h4>Top Users</h4>
    <?php foreach ($topUsers as $user): ?>
        <div class="pints-wrapper">
            <div class="left-user3898">
                <a href="#"><img src="<?php echo htmlspecialchars($user['profileImage']); ?>" alt="Image"></a>
                <div class="imag-overlay39"> <a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a> </div>
            </div>
            <span class="points-details938">
                <a href="#"><h5><?php echo htmlspecialchars($user['username']); ?></h5></a>
                <br>
                <small>Posts: <?php echo $user['postsCount']; ?></small>
            </span>
        </div>
        <hr>
    <?php endforeach; ?>
</div>
<!--               end of Highest points -->
<!--          start tags part-->
<div class="tags-part2398">
    <h4>Tags</h4>
    <ul>
    <li><a href="#">grammar</a></li>
    <li><a href="#">spelling</a></li>
    <li><a href="#">writing</a></li>
    <li><a href="#">pronounciation</a></li>
    <li><a href="#">verbs</a></li>
    <li><a href="#">speaking</a></li>
    <li><a href="#">adjectives</a></li>
    <li><a href="#">nouns</a></li>
    <li><a href="#">communication skills</a></li>
    </ul>
</div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="../public/js/askQuestion.js"></script>
  
</body>

</html>