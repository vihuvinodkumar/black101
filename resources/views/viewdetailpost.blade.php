<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <title>View Post</title>
</head>
<script>
    $(document).ready(function() {
        $('#post p:nth-child(4)').each(function() {
            var originalDate = $(this).text(); // Get the original date

            // Convert the date to the desired format (e.g., DD/MM/YYYY)
            var formattedDate = moment(originalDate).format('DD/MM/YYYY');

            $(this).text(formattedDate); // Update the cell content with the formatted date
        });



        function getVideoIdFromLink(videoLink) {
            // Regular expression to match the video ID
            // const regExp = /(?:vimeo\.com\/|youtu\.be\/|youtube\.com\/(?:watch\?(?:\S*&)*v=|embed\/|v\/)|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{10,12})/i;
            const regExp = /vimeo\.com\/(?:.*\/)?(\d+)/i;

            // Match the video ID using the regular expression
            const match = videoLink.match(regExp);

            if (match) {
                return match[1]; // Return the video ID
            } else {
                return null; // Return null if no video ID found
            }
        }
        // Get the reference to the iframe element
        const videoFrame = document.getElementById('videoFrame');
        const url = document.getElementById('url');
        console.log(url.textContent)
        // Define the dynamic URL
        const videoUrl = "https://player.vimeo.com/video/" + getVideoIdFromLink(url.textContent) + "?autoplay=1&loop=1&autopause=0&api=1&controls=0&muted=1?playsinline=0";

        // Set the dynamic URL to the iframe src
        videoFrame.src = videoUrl;

    })
</script>

<body>
    <div class="container">
        <div class="post" id="post">
            <div class="post__image">
                <img src="{{ 'http://100.25.19.89/black101/public/storage'.str_replace('public', '', $post->thumbnail ?: '') }}" />

                @if($post->type==='V')
                <iframe class="b-hero_image lazy" id="videoFrame" width="100%" style="margin-top:50px;" height="240" frameborder="0" allow="autoplay; 
         fullscreen" allowfullscreen muted playsinline>
                </iframe>
                @endif
                @if($post->type==='T')
                <h3 style="margin-top:50px;"><i>{{$post->url}}</i></h3>
                @endif

            </div>
            <div class="post__content">
                <h1 class="post__title">{{ $post->headline }}</h1>
                <p class="post__subheadline">{{ $post->sub_headline }}</p>
                <p class="post__subheadline" id="url" style="display:none">{{ $post->url }}</p>
                <p class="post__overview">{{ $post->overview }}</p>
                <p class="post__publish_at">Publish at : {{ $post->publish_at }}</p>
                <p class="post__cft">{{ $post->cft }}</p>
                <p class="post__day_of_publish">Day of publish :- {{ $post->day_of_publish }}</p>
            </div>
        </div>
    </div>
</body>

</html>
<style>
    .container {
        max-width: 960px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .post {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 30px;
    }

    .post__image {
        flex: 1;
        max-width: 100%;
        margin-right: 30px;
    }

    .post__image img {
        display: block;
        max-width: 100%;
    }

    .post__content {
        flex: 1;
        max-width: 600px;
    }

    .post__title {
        font-size: 40px;
        margin-top: 0;
        margin-bottom: 10px;
    }

    .post__subheadline {
        font-size: 30px;
        margin-top: 0;
        margin-bottom: 20px;
    }

    .post__overview {
        font-size: 20px;
        margin-bottom: 20px;
    }

    .post__publish_at,
    .post__cft,
    .post__day_of_publish {
        font-size: 16px;
        margin-bottom: 10px;
    }

    @media (max-width: 767px) {
        .post {
            flex-direction: column;
        }

        .post__image,
        .post__content {
            flex: none;
            max-width: 100%;
            margin-right: 0;
        }

        .post__image img {
            margin-bottom: 20px;
        }

        .post__title {
            font-size: 30px;
        }

        .post__subheadline {
            font-size: 24px;
        }

        .post__overview {
            font-size: 18px;
        }

        .post__publish_at,
        .post__cft,
        .post__day_of_publish {
            font-size: 14px;
        }
    }

    .card {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 30px;
    }

    .card__image {
        flex: 1;
        max-width: 100%;
        margin-right: 30px;
    }

    .card__image img {
        display: block;
        max-width: 100%;
    }

    .card__content {
        flex: 1;
        max-width: 600px;
    }

    .card__title {
        font-size: 24px;
        margin-top: 0;
        margin-bottom: 10px;
    }

    .card__text {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .card__button {
        display: inline-block;
        background-color: #000;
        color: #fff;
        padding: 10px 20px;
        font-size: 16px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .card__button:hover {
        background-color: #333;
    }

    @media (max-width: 767px) {
        .card {
            flex-direction: column;
        }

        .card__image,
        .card__content {
            flex: none;
            max-width: 100%;
            margin-right: 0;
        }

        .card__button {
            display: block;
            margin-top: 20px;
        }

        .card__title {
            font-size: 20px;
        }

        .card__text {
            font-size: 16px;
        }

        .card__button {
            font-size: 14px;
        }
    }
</style>