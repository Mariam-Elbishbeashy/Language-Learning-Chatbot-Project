<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customizable Language Learning Path</title>
    <link rel="stylesheet" href="./css/Stylehome.css">
    <link rel="stylesheet" href="./css/styleuserprofile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }


.form-check-input {
    width: 20px; 
    height: 20px;
    margin-top: 0.3rem;
    cursor: pointer;
    position: relative;
    appearance: none; 
    border: 2px solid #4D1193; 
    border-radius: 5px;
    background-color: #ffffff;
    transition: background-color 0.3s, border-color 0.3s;
}

.form-check-input:checked {
    background-color: #4D1193; 
    border-color: #4D1193; 
}

.form-check-input:checked::after {
    content: '\2713'; 
    position: absolute;
    color: white;
    font-weight: bold;
    font-size: 18px;
    left: 3px;
    top: -2px;
}

.form-check-input:hover {
    border-color: #3d0f73; 
    box-shadow: 0 0 5px rgba(77, 17, 147, 0.5); 
}


        .form-group label {
            font-weight: bold;
            color: #4D1193;
        }

        .btn-primary {
            background-color: #4D1193;
            border: 1px solid #4D1193;
        }

        .btn-primary:hover {
            background-color: #3d0f73;
            border-color: #3d0f73;
        }

        .form-icon {
            position: absolute;
            margin: 10px;
            color: #4D1193;
        }

        .form-control {
            padding-left: 40px; 
        }

        .form-group {
            position: relative; 
        }

     
        .modal-content {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container" style="padding-right: 0px; padding-left: 0px;">
    <?php include "../Language-Learning-Chatbot/views/partials/navbar.php"; ?>
        <div class="main-content" style="align-items:center; width:80%;">
            <div class="row gutters">

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">

                            <!-- Customizable Language Learning Path Section -->
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2" style="color:white;  background:#4D1193; text-align:center;          margin:10px;padding:10px;  font-size:larger;">Customize Your Learning Path</h6>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Difficulty Level</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="beginner" id="difficultyBeginner">
                                            <label class="form-check-label" for="difficultyBeginner">Beginner</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="intermediate" id="difficultyIntermediate">
                                            <label class="form-check-label" for="difficultyIntermediate">Intermediate</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="advanced" id="difficultyAdvanced">
                                            <label class="form-check-label" for="difficultyAdvanced">Advanced</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Focus Areas</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="speaking" id="focusSpeaking">
                                            <label class="form-check-label" for="focusSpeaking"><i class="fas fa-comments"></i> Speaking</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="listening" id="focusListening">
                                            <label class="form-check-label" for="focusListening"><i class="fas fa-headphones-alt"></i> Listening</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="writing" id="focusWriting">
                                            <label class="form-check-label" for="focusWriting"><i class="fas fa-pencil-alt"></i> Writing</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="reading" id="focusReading">
                                            <label class="form-check-label" for="focusReading"><i class="fas fa-book-open"></i> Reading</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="personalInterests">Personal Interests</label>
                                        <textarea class="form-control" id="personalInterests" rows="3" placeholder="Describe your interests..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Languages</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="english" id="languageEnglish">
                                            <label class="form-check-label" for="languageEnglish"><i class="fas fa-globe"></i> English</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="french" id="languageFrench">
                                            <label class="form-check-label" for="languageFrench"><i class="fas fa-globe"></i> French</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="spanish" id="languageSpanish">
                                            <label class="form-check-label" for="languageSpanish"><i class="fas fa-globe"></i> Spanish</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="button" id="saveButton" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for displaying selected options -->
        <div class="modal fade" id="selectionModal" tabindex="-1" role="dialog" aria-labelledby="selectionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="selectionModalLabel">Your Selections</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        <!-- Selected options will be populated here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#saveButton').click(function() {
                 
                    const difficulty = [];
                    $('input[type="checkbox"]:checked').each(function() {
                        if ($(this).attr('id').startsWith('difficulty')) {
                            difficulty.push($(this).val());
                        }
                    });

                    const focusAreas = [];
                    $('input[type="checkbox"]:checked').each(function() {
                        if ($(this).attr('id').startsWith('focus')) {
                            focusAreas.push($(this).val());
                        }
                    });

                    const languages = [];
                    $('input[type="checkbox"]:checked').each(function() {
                        if ($(this).attr('id').startsWith('language')) {
                            languages.push($(this).val());
                        }
                    });

                    const interests = $('#personalInterests').val();

                   
                    $('#modalBody').html(`
                        <p><strong>Difficulty Level:</strong> ${difficulty.join(', ') || 'None'}</p>
                        <p><strong>Focus Areas:</strong> ${focusAreas.join(', ') || 'None'}</p>
                        <p><strong>Languages:</strong> ${languages.join(', ') || 'None'}</p>
                        <p><strong>Personal Interests:</strong> ${interests || 'None'}</p>
                    `);

               
                    $('#selectionModal').modal('show');
                });
            });
        </script>
    </div>
</body>

</html>