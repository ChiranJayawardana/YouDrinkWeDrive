 <!-- Header-->
 <!-- <header class="bg-dark py-5" id="main-header">
    <div class="container h-100 d-flex align-items-end justify-content-center w-100">
        <div class="text-center text-white w-100">
            <h1 class="display-4 fw-bolder mx-5">About Us</h1>
        </div>
    </div>
</header> -->
<!-- <section class="py-5">
    <div class="container">
        <div class="card rounded-0 card-outline card-purple shadow px-4 px-lg-5 mt-5">
            <div class="row">
            <div class="card-body">
                <h4>Contact Form</h4>
            </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).scroll(function() { 
        $('#topNavBar').removeClass('bg-purple navbar-light navbar-dark bg-gradient-purple text-light')
        if($(window).scrollTop() === 0) {
           $('#topNavBar').addClass('navbar-dark bg-purple text-light')
        }else{
           $('#topNavBar').addClass('navbar-dark bg-gradient-purple ')
        }
    });
    $(function(){
        $(document).trigger('scroll')
    })
</script> -->

<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Chatbot Integration</title>
    <link rel="stylesheet" href="<?php echo base_url ?>style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
</head>
<body>
    <!-- Header (Optional: Uncomment if needed) -->
    <!-- <header class="bg-dark py-5" id="main-header">
        <div class="container h-100 d-flex align-items-end justify-content-center w-100">
            <div class="text-center text-white w-100">
                <h1 class="display-4 fw-bolder mx-5">About Us</h1>
            </div>
        </div>
    </header> -->

    <style>
        .contact-hero {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            padding: 80px 0 60px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .contact-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.3;
        }
        .contact-hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }
        .contact-hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        .contact-hero p {
            font-size: 1.25rem;
            opacity: 0.95;
        }
        .wrapper {
            max-width: 700px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.1);
        }
        .wrapper .title {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            padding: 25px;
            border-radius: 20px 20px 0 0;
        }
        .wrapper .form {
            padding: 25px;
            max-height: 500px;
            overflow-y: auto;
        }
        .wrapper .typing-field {
            padding: 20px 25px;
            border-top: 2px solid #e2e8f0;
        }
        .wrapper .input-data {
            display: flex;
            gap: 10px;
        }
        .wrapper .input-data input {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .wrapper .input-data input:focus {
            outline: none;
            border-color: #06b6d4;
            box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.1);
        }
        .wrapper .input-data button {
            padding: 12px 30px;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            border: none;
            border-radius: 25px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .wrapper .input-data button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
        }
        .inbox {
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 12px;
        }
        .bot-inbox {
            background: #f0fdfa;
            border: 2px solid #06b6d4;
        }
        .user-inbox {
            background: #06b6d4;
            color: white;
            margin-left: auto;
            max-width: 80%;
        }
        .icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
        }
    </style>

    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container contact-hero-content">
            <h1><i class="fas fa-comments"></i> Contact Us</h1>
            <p>We're here to help! Chat with our AI assistant or reach out to our support team</p>
        </div>
    </section>

    <!-- Chat Section -->
    <section class="py-5" style="background: #f8fafc;">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Chatbot UI -->
                    <div class="wrapper">
                        <div class="title">
                            <i class="fas fa-robot"></i> Chat with Us
                        </div>
                            <div class="form">
                                <div class="bot-inbox inbox">
                                    <div class="icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="msg-header">
                                        <div class="markdown-content">
                                            <p>Hello there, how can I help you?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="typing-field">
                                <div class="input-data">
                                    <input id="data" type="text" placeholder="Type something here.." required>
                                    <button id="send-btn">Send</button>
                                </div>
                            </div>
                        </div>
                        <!-- End of Chatbot UI -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Navbar Scroll Script -->
    <script>
        $(document).scroll(function() { 
            $('#topNavBar').removeClass('bg-purple navbar-light navbar-dark bg-gradient-purple text-light')
            if($(window).scrollTop() === 0) {
               $('#topNavBar').addClass('navbar-dark bg-purple text-light')
            } else {
               $('#topNavBar').addClass('navbar-dark bg-gradient-purple ')
            }
        });
        $(function(){
            $(document).trigger('scroll')
        })
    </script>

    <!-- Chatbot AJAX Script -->
    <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><div class="markdown-content"><p>'+ $value +'</p></div></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // Start AJAX code
                $.ajax({
                    url: '<?php echo base_url ?>message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        // Parse markdown result
                        var parsedResult = marked.parse(result);
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><div class="markdown-content">'+ parsedResult +'</div></div></div>';
                        $(".form").append($replay);
                        // When chat goes down, the scroll bar automatically moves to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
</body>
</html>
