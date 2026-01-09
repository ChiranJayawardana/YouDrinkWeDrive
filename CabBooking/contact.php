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

    <!-- Contact Page Header -->
    <header class="hero-modern" style="min-height: 40vh;">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="hero-modern-content text-center">
                <h1 class="hero-modern-title">Contact Us</h1>
                <p class="hero-modern-subtitle">We're here to help and answer any question you might have</p>
            </div>
        </div>
    </header>

    <!-- Contact Information & Chat Section -->
    <section style="padding: 4rem 0; background: #f3f4f6;">
        <div class="container">
            <div class="row mb-5">
                <!-- Contact Information Cards -->
                <div class="col-md-4 mb-4">
                    <div class="card-modern text-center fade-in-scroll">
                        <div style="width: 60px; height: 60px; margin: 0 auto 1rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-phone" style="font-size: 1.5rem; color: white;"></i>
                        </div>
                        <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;">Call Us</h4>
                        <p style="color: #6b7280;">+1 (555) 123-4567</p>
                        <p style="color: #6b7280; font-size: 0.875rem;">Mon-Sun, 24/7</p>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card-modern text-center fade-in-scroll">
                        <div style="width: 60px; height: 60px; margin: 0 auto 1rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-envelope" style="font-size: 1.5rem; color: white;"></i>
                        </div>
                        <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;">Email Us</h4>
                        <p style="color: #6b7280;">support@cabbooking.com</p>
                        <p style="color: #6b7280; font-size: 0.875rem;">We'll respond within 24 hours</p>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card-modern text-center fade-in-scroll">
                        <div style="width: 60px; height: 60px; margin: 0 auto 1rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: white;"></i>
                        </div>
                        <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;">Visit Us</h4>
                        <p style="color: #6b7280;">123 Main Street</p>
                        <p style="color: #6b7280; font-size: 0.875rem;">New York, NY 10001</p>
                    </div>
                </div>
            </div>
            
            <!-- Chatbot Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card-modern fade-in-scroll" style="max-width: 800px; margin: 0 auto;">
                        <div class="text-center mb-4">
                            <h3 style="font-size: 1.75rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">
                                <i class="fas fa-comments mr-2" style="color: #9333ea;"></i>
                                Live Chat Support
                            </h3>
                            <p style="color: #6b7280;">Get instant answers to your questions</p>
                        </div>
                        
                        <!-- Chatbot UI -->
                        <div class="wrapper" style="width: 100%; margin: 0;">
                            <div class="title">Chat with Us</div>
                            <div class="form">
                                <div class="bot-inbox inbox">
                                    <div class="icon">
                                        <i class="fas fa-robot"></i>
                                    </div>
                                    <div class="msg-header">
                                        <div class="markdown-content">
                                            <p>Hello there! 👋 How can I help you today?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="typing-field">
                                <div class="input-data">
                                    <input id="data" type="text" placeholder="Type your message here..." required>
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
