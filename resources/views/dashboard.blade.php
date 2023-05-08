<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('js/dashboard.js') }}">
    <link rel="stylesheet" href="{{ asset('js/sidebar/sidebar.js') }}">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



</head>

<body>
    <div class="container-fluid">

        <div class="col-lg-12">
            @include("/sidebar/sidebar")

        </div>
        <div class="col-lg-12 my-5">

            <div class="row w-row">
                <div class="basic-column w-col w-col-3">
                    <div class="tag-wrapper">
                        <div class="number-card number-card-content1">
                            <h1 class="number-card-number">{{$total_user}}</h1>
                            <div class="number-card-dollars">Total Active Users</div>
                            <div class="number-card-divider"></div>
                            <div class="number-card-progress-wrapper">
                                <div class="tagline number-card-currency">-</div>
                                <div class="number-card-progress">10 min ago</div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="basic-column w-col w-col-3">
                    <div class="tag-wrapper">
                        <div class="number-card number-card-content2">
                            <h1 class="number-card-number">{{$total_post}}</h1>
                            <div class="number-card-dollars">Total Post</div>
                            <div class="number-card-divider"></div>
                            <div class="number-card-progress-wrapper">
                                <div class="tagline number-card-currency">-</div>
                                <div class="number-card-progress">10 min ago</div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="basic-column w-col w-col-3">
                    <div class="tag-wrapper">
                        <div class="number-card number-card-content3">
                            <h1 class="number-card-number">{{$total_rating}}</h1>
                            <div class="number-card-dollars">Total Likes</div>
                            <div class="number-card-divider"></div>
                            <div class="number-card-progress-wrapper">
                                <div class="tagline number-card-currency">-</div>
                                <div class="number-card-progress">10 min ago</div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="basic-column w-col w-col-3">
                    <div class="tag-wrapper">
                        <div class="number-card number-card-content4">
                            <h1 class="number-card-number">{{ $total_donation }}</h1>
                            <div class="number-card-dollars">Total Donation</div>
                            <div class="number-card-divider"></div>
                            <div class="number-card-progress-wrapper">
                                <div class="tagline number-card-currency">-</div>
                                <div class="number-card-progress">10 min ago</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <span class="text-center">Lastest Post</span>
            <div class="row">
                @foreach($latest_post as $item)

                <div class="card">
                    <div class="card__image">
                        <img src="{{ 'http://100.25.19.89/black101/public/storage'.str_replace('public', '', $item->thumbnail?:'') }}" />

                    </div>
                    <div class="card__content">
                        <p class="card__title">{{$item->headline}}</p>
                        <p class="card__text">{{$item->sub_headline}}</p>
                        <a class="card__button" href="">Read More</a>
                    </div>
                </div>

                @endforeach
            </div>

        </div>
        <!-- <video autoplay muted loop id="myVideo">
            <source src="/storage/tasks/document/dashboard.mp4" type="video/mp4">
        </video> -->



    </div>
</body>

</html>

<style>
    .card {
        position: relative;
        width: 300px;
        height: 400px;
        margin: 20px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.5s cubic-bezier(0.215, 0.61, 0.355, 1);
    }

    .card__image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        border-radius: 10px;
    }

    .card__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.215, 0.61, 0.355, 1);
    }

    .card__content {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 20px;
        background-color: #fff;
        transition: transform 0.5s cubic-bezier(0.215, 0.61, 0.355, 1);
    }

    .card__title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card__text {
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .card__button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #000;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card:hover .card__image img {
        transform: scale(1.2);
    }

    .card:hover .card__content {
        transform: translateY(-100%);
    }

    .card__image {
        height: 400px;
        width: 300px;
        background-color: #000;
        /* you can put img url here  */
    }

    h1 {
        font-size: 2em;
        margin: .67em 0;
    }

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        font-family: Roboto, sans-serif;
    }

    h1 {
        font-weight: bold;
        margin-bottom: 10px;
    }

    h1 {
        font-size: 38px;
        line-height: 44px;
        margin-top: 20px;
    }

    .w-row:before,
    .w-row:after {
        content: " ";
        display: table;
    }

    .w-row:after {
        clear: both;
    }

    .w-col {
        position: relative;
        float: left;
        width: 100%;
        min-height: 1px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .w-col-3 {
        width: 25%;
    }

    @media screen and (max-width:767px) {
        .w-row {
            margin-left: 0;
            margin-right: 0;
        }

        .w-col {
            width: 100%;
            left: auto;
            right: auto;
        }
    }

    @media screen and (max-width:479px) {
        .w-col {
            width: 100%;
        }
    }

    h1 {
        margin-top: 15px;
        margin-bottom: 15px;
        font-size: 42px;
        line-height: 54px;
        font-weight: 400;
    }

    .divider {
        height: 1px;
        margin-top: 20px;
        margin-bottom: 15px;
        background-color: #eee;
    }

    .style-label {
        color: #bebebe;
        font-size: 12px;
        line-height: 20px;
        font-weight: 500;
        text-transform: uppercase;
    }

    .tag-wrapper {
        margin-top: 35px;
        margin-bottom: 35px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .row {
        margin-bottom: 50px;
    }

    .number-card-number {
        margin-top: 0px;
        margin-bottom: 0px;
        color: #fff;
        font-weight: 300;
    }

    .tagline {
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .tagline.number-card-currency {
        color: #fff;
    }

    .basic-column {
        padding-right: 5px;
        padding-left: 5px;
    }

    .number-card {
        padding: 22px 30px;
        border-radius: 8px;
        background-image: -webkit-linear-gradient(270deg, #1991eb, #1991eb);
        background-image: linear-gradient(180deg, #1991eb, #1991eb);
    }

    .number-card.number-card-content3 {
        background-image: -webkit-linear-gradient(270deg, #ed629a, #c850c0);
        background-image: linear-gradient(180deg, #ed629a, #c850c0);
    }

    .number-card.number-card-content4 {
        background-image: -webkit-linear-gradient(270deg, #ff8308, #fd4f00);
        background-image: linear-gradient(180deg, #ff8308, #fd4f00);
    }

    .number-card.number-card-content2 {
        display: block;
        background-image: -webkit-linear-gradient(270deg, #17cec4, #17cec4 0%, #08aeea);
        background-image: linear-gradient(180deg, #17cec4, #17cec4 0%, #08aeea);
        color: #333;
    }

    .number-card.number-card-content1 {
        background-image: -webkit-linear-gradient(270deg, #7042bf, #3023ae);
        background-image: linear-gradient(180deg, #7042bf, #3023ae);
    }

    .number-card-progress-wrapper {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -webkit-justify-content: space-between;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .number-card-divider {
        height: 1px;
        margin-top: 10px;
        margin-bottom: 14px;
        background-color: hsla(0, 0%, 100%, .15);
    }

    .number-card-dollars {
        color: hsla(0, 0%, 100%, .8);
        font-size: 16px;
        line-height: 24px;
    }

    .number-card-progress {
        color: #fff;
        text-align: right;
    }

    @media (max-width: 991px) {
        .number-card-number {
            font-size: 30px;
        }

        .number-card {
            padding-top: 12px;
            padding-bottom: 16px;
        }
    }
</style>