<?php
require_once '../Language-Learning-Chatbot/controllers/forumController.php';

$forumController = new forumController();
$questions = $forumController->loadQuestions();

function timeAgo($datetime) {
    $time = strtotime($datetime);
    $timeDiff = time() - $time;

    if ($timeDiff < 60) {
        return 'Just now';
    } elseif ($timeDiff < 3600) {
        return floor($timeDiff / 60) . ' minutes ago';
    } elseif ($timeDiff < 86400) {
        return floor($timeDiff / 3600) . ' hours ago';
    } elseif ($timeDiff < 604800) {
        return floor($timeDiff / 86400) . ' days ago';
    } else {
        return date('F j, Y', $time);
    }
}
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
    <title>Ask Me</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="../public/css/forum.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
    <!--======== Navbar =======-->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="navbar-serch-right-side">
                        <form class="navbar-form" role="search">
                            <div class="input-group add-on">
                                <input class="form-control form-control222" placeholder="Search" id="srch-term" type="text">
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-default2913" type="button"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- ==========header mega navbar=======-->
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
            </div>
        </nav>
    </div>
   

<section class="welcome-part-one">
    <div class="container">
        <div class="welcome-demop102 text-center">
            <h2>Welcome to Ask Me!</h2>
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <div class="slide-content box">
                        <img src="./images/welcome.jpg" style="width:30%; float:left; margin-right:20px;">
                        <p>Welcome to our language learning community! Here, you'll find resources to help you master new languages, connect with fellow learners, and enhance your linguistic skills.</p>
                    </div>
                </div>
                <div class="mySlides fade">
                    <div class="slide-content box">
                        <img src="./images/rules.jpg" style="width:30%; float:left; margin-right:20px;">
                        <p>Our rules are simple: Be respectful, stay on topic, and always aim to help others. Let's keep this community positive and constructive!</p>
                    </div>
                </div>
                <div class="mySlides fade">
                    <div class="slide-content box">
                        <img src="./images/ask.jpg" style="width:30%; float:left; margin-right:20px;">
                        <p>Feel free to ask questions, share your progress, and participate in discussions. We're all here to learn and grow together.</p>
                    </div>
                </div>
            </div>
        </div>
   
<!-- 
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square" aria-hidden="true"></i></span>
            <input type="text" class="form-control form-control8392" placeholder="Ask any question and you be sure find your answer ?">
            <span class="input-group-addon"><a href="#">Ask Now</a></span>
        
            </div> -->
            </div>
        </div>
    </section>
    
    
    <!-- ======content section/body=====-->
    <section class="main-content920">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div id="main">
                        <input id="tab1" type="radio" name="tabs" checked>
                        <label for="tab1">All Questions</label>
                        <!--missing-->
                        
                        <section id="content1"> 
    <!-- Question 1 -->
    <div class="question-type2033">
        <div class="row">
            <div class="col-md-1">
                <div class="left-user12923 left-user12923-repeat">
                    <a href="#"><img src="./images/boy.png" alt="image"> </a>
                    <a href="#"><i class="fa fa-check" aria-hidden="true"></i></a>
                    <p style="text-align: center; font-size: 12px; margin-top: 5px;">jake123</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="right-description893">
                    <div id="que-hedder2983">
                        <h3><a href="#" target="_blank">How to Conjugate Verbs in French Past Tense?</a></h3>
                    </div>
                    <div class="ques-details10018">
                        <p>Can someone explain the rules for conjugating verbs in the past tense in French? I keep getting confused with the -er, -ir, and -re verb endings.</p>
                    </div>
                    <hr>
                    <div class="ques-icon-info3293">
                        <a href="#"><i class="fa fa-star" aria-hidden="true"> 3 </i></a>
                        <a href="#"><i class="fa fa-folder" aria-hidden="true"> French</i></a>
                        <a href="#"><i class="fa fa-clock-o" aria-hidden="true"> 10 min ago</i></a>
                        <a href="#"><i class="fa fa-question-circle-o" aria-hidden="true"> Comment</i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="ques-type302">
                        <button type="button" class="q-type238"><i class="fa fa-comment" aria-hidden="true"></i></button>
                        <button type="button" class="q-type23 button-ques2973"><i class="fa fa-user-circle-o" aria-hidden="true"> 19 views</i></button>
                </div>
            </div>
        </div>
        <div class="comments-lists">
    </div>
    </section>
          <!--missing-->    
          <?php if (!empty($questions)): ?>
            <?php foreach ($questions as $question): ?>
                <div class="question-type2033">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="left-user12923 left-user12923-repeat">
                            <img src="<?php echo htmlspecialchars($question['profileImage']); ?>" alt="Profile Image">
                                <a href="#"><i class="fa fa-check" aria-hidden="true"></i></a>
                                <p style="text-align: center; font-size: 12px; margin-top: 5px;"><?php echo htmlspecialchars($question['username']); ?></p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="right-description893">
                                <div id="que-hedder2983">
                                    <h3><a href="#" target="_blank"><?php echo htmlspecialchars($question['title']); ?></a></h3>
                                </div>
                                <div class="ques-details10018">
                                    <p><?php echo htmlspecialchars($question['content']); ?></p>
                                </div>
                                <hr>
                                <div class="ques-icon-info3293">
                                    <a href="#"><i class="fa fa-star" aria-hidden="true"> 0 </i></a>
                                    <a href="#"><i class="fa fa-folder" aria-hidden="true"> <?php echo htmlspecialchars($question['category']); ?></i></a>
                                    <a href="#"><i class="fa fa-clock-o" aria-hidden="true"> <?php echo timeAgo($question['created_at']); ?></i></a>
                                    <a href="#"><i class="fa fa-question-circle-o" aria-hidden="true"> Comment</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="ques-type302">
                                <button type="button" class="q-type238"><i class="fa fa-comment" aria-hidden="true"></i></button>
                                <button type="button" class="q-type23 button-ques2973"><i class="fa fa-user-circle-o" aria-hidden="true"> 0 views</i></button>
                            </div>
                        </div>
                    </div>
                    <div class="comments-lists"></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No questions have been posted yet. Be the first to ask!</p>
        <?php endif; ?>
            
    </div>
    </div>
                <!--end of col-md-9 -->
                <!--strart col-md-3 (side bar)-->
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
                        <div class="pints-wrapper">
                            <div class="left-user3898">
                                <a href="#"><img src="./images/boy.png" alt="Image"></a>
                                <div class="imag-overlay39"> <a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a> </div>
                            </div> <span class="points-details938">
                            <a href="#"><h5>ahmed2002</h5></a>
                            <br>
                            </span> </div>
                        <hr>
                        <div class="pints-wrapper">
                            <div class="left-user3898">
                                <a href="#"><img src="./images/girl.png" alt="Image"></a>
                                <div class="imag-overlay39"> <a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a> </div>
                            </div> <span class="points-details938">
                            <a href="#"><h5>emily03</h5></a>
                            <br>
                            </span> </div>
                        <hr>
                        <div class="pints-wrapper">
                            <div class="left-user3898">
                                <a href="#"><img src="./images/girl.png" alt="Image"></a>
                                <div class="imag-overlay39"> <a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a> </div>
                            </div> <span class="points-details938">
                            <a href="#"><h5>dalia77</h5></a>
                            <br>
                            </span> </div>
                        <hr>
                        <div class="pints-wrapper">
                            <div class="left-user3898">
                                <a href="#"><img src="./images/boy.png" alt="Image"></a>
                                <div class="imag-overlay39"> <a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a> </div>
                            </div> <span class="points-details938">
                            <a href="#"><h5>liam099</h5></a>
                            <br>
                            </span> </div>
                        <hr>
                        <div class="pints-wrapper">
                            <div class="left-user3898">
                                <a href="#"><img src="./images/girl.png" alt="Image"></a>
                                <div class="imag-overlay39"> <a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a> </div>
                            </div> <span class="points-details938">
                            <a href="#"><h5>alice05</h5></a>
                            <br>
                            </span> </div>
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
 
                </aside>
            </div>
        </div>
    </section>
    <script src="../public/js/forum.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/npm.js"></script>
</body>

</html>