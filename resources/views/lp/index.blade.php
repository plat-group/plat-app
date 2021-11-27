<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/lp/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/lp/css/app.css">
    <link rel="stylesheet" href="static/lp/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='https://cdn.rawgit.com/daneden/animate.css/v3.1.0/animate.min.css'>
    <link rel="stylesheet" href="static/lp/css/LineIcons.css">
    <link rel="stylesheet" href="static/lp/css/font-awesome.min.css">
    <link rel="shortcut icon" href="static/lp/images/favicon.png" type="image/png">


    <title>Plat Solution</title>


</head>
<body>
      <!--====== PRELOADER PART START ======-->

      <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <div id="banner">
        <div id="particles-1" class="particles"></div>

        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">
                    <img class="w-50" src="static/lp/images/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav ml-auto list-icon_social">
                    <li class="nav-item active">
                        <a href="">
                            <i class="icon-social lni-facebook-filled"></i>
                        </a>
                    </li>
                    <li class="nav-item  ">

                        <a href="">
                            <i class=" icon-social lni-twitter-filled "></i>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="https://lineicons.com/icons/?search=user">
                            <i class=" icon-social lni-instagram-filled"></i>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route(POOL_GAME_ROUTE)}}">
                            <i class=" icon-social lni-user"></i>
                        </a>
                    </li>
                </ul>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav ml-auto menu pt-4">
                        <li class="nav-item active">
                            <a class="nav-link page-scroll" href="#banner">Overview</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link page-scroll" href="#Features">Features</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link page-scroll" href="#Roadmap">Roadmap</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link page-scroll" href="#Team">Team</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link page-scroll" href="#Resources">Resource</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <article>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <img class="img-fluid" src="static/lp/images/plat.png" alt="">
                        <p class="text-white mt-2">
                            Plat Chain is a platform that helps enterprises create their brand and NFT associated BaGames (Blockchain Advertising Games) and issue that BaGames on multiple Online Advertising services.
                        </p>
                    </div>
                </div>
            </div>
        </article>
    </div>
    <article class="py-5 position-relative "  id="detail">
        <div class="">
            <div class="row "   id="detail-content">
                <div data-wow-delay="0.5s" class="col-lg-6 one col-md-6 wow bounceInLeft" >
                    <img src="static/lp/images/phoi1.png" class="" alt="">
                </div>
                <div data-wow-delay="0.5s"  class="col-md-5  tow wow bounceInRight col-lg-5 align-items-center content  d-flex">
                    <div class="text-right">
                        <h2>Creators BaGames / Template</h2>
                        <p>
                            By using PLAT Middleware, Game makers (Creators) can easily add Onchain features, parameters related to NFTs and Tokens into traditional Games in order to create BaGames (Blockchain Advertising Games).
                        </p>
                        <div class="text-right pr-2">
                            <button class="btn btn-show">Show more</button>
                        </div>
                    </div>

                </div>
            </div>

            <div class=" position-relative ">
                     <div data-wow-delay="0.5s"  class="position-absolute  wow bounceInRight stoke d-none d-md-block">
                        <img class="img-fluid " src="static/lp/images/strore.png" alt="">

                    </div>
                <div class="row">
                    <div data-wow-delay="0.5s" class="col-md-4 three  col-lg-5 wow bounceInLeft align-items-center content  d-flex col-sm-12">
                        <div class=" my-4 px-md-5">
                            <h2>Branding & NFTs</h2>
                            <p>
                                Enterprises that need advertisement (Clients) can easily choose BaGames and add their own
                                Branding, NFTs and edit the amount of reward Tokens (Bonus Tokens) without coding Smart Contract.
                                After adding properties to BaGame with their own characteristics, Clients can immediately push to the
                                advertising system of the advertising service providers (Providers)
                            </p>
                            <div class="text-left pr-2">
                                <button class="btn btn-show">Show more</button>
                            </div>
                        </div>

                    </div>



                    <div data-wow-delay="0.5s" class="col-lg-7 fore col-md-8 first phoi2 wow bounceInRight">
                        <img class="" src="static/lp/images/phoi-2.png" alt="">
                    </div>

                </div>
            </div>
            <div class="row">
                <div data-wow-delay="0.5s" class="col-md-6 five col-lg-6 wow bounceInLeft">
                    <img class="img-fluid" src="static/lp/images/phoi-3.png" alt="">
                </div>
                <div data-wow-delay="0.5s" class="col-md-5 mx-2 six col-lg-5 d-flex align-items-center wow bounceInRight">
                    <div class="text-left">
                        <h2>Providers' system User use</h2>
                        <p>
                            Users will Play/Watch BaGame and then interact and give service feedbacks for Clients. The more you play, interact and feedback, the more users have the opportunity to earn Tokens and NFTs in the game.
                        </p>
                        <div class="text-left pr-2">
                            <button class="btn btn-show">Show more</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="stoke2 d-none d-md-block" style="z-index: 1;">
            <img src="static/lp/images/phoi2.png"  alt="">
        </div>




    </article>
    <article id="Features" class="py-5">
        <div class="container">
            <div class="text-center">
                <h2 class="text-white">FEATURES</h2>
                <img src="static/lp/images/stoke3.png" alt="">
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4 py-2">
                    <h6 class=" d-flex align-items-center">
                        <img src="static/lp/images/icon/earn 1.png"  alt="">
                        <span class='px-2 d-block'>PLAT To Earn</span>

                    </h6>
                </div>
                <div class="col-md-4 col-lg-4 py-2">
                    <h6 class=" d-flex align-items-center">
                        <img src="static/lp/images/icon/m4p-file 1.png" class="img-fluid"  alt="">
                        <span class='px-2 d-block'>Middleware to convert from Games to BaGames fastest</span>


                    </h6>
                </div>
                <div class="col-md-4 col-lg-4 py-2">
                    <h6 class="d-flex align-items-center">
                        <img src="static/lp/images/icon/nft 1.png"  alt="">
                        <span class='px-2 d-block'>NFTs - NFTs Market</span>

                    </h6>
                </div>
                <div class="col-md-4 col-lg-4 py-2">
                    <h6 class="d-flex align-items-center">
                        <img src="static/lp/images/icon/library1.png"  alt="">
                        <span class='px-2 d-block'>BaGames Library</span>

                    </h6>
                </div>
                <div class="col-md-4 col-lg-4 py-2">
                    <h6 class="d-flex align-items-center">
                        <img src="static/lp/images/icon/brand 1.png"  alt="">
                        <span class='px-2 d-block'>Brandings</span>

                    </h6>
                </div>
                <div class="col-md-4 col-lg-4 py-2">
                    <h6 class="d-flex align-items-center">
                        <img src="static/lp/images/icon/coding 1.png"  alt="">
                        <span class='px-2 d-block'>Nocode to Making NFTs & Embed Branding & NFTs</span>

                    </h6>
                </div>
            </div>
        </div>
    </article>
    <article id="why-plad">
        <div class="container ">
            <div class="text-center">
                <h2 class="text-white pt-5">WHY PLAD</h2>
                <img src="static/lp/images/stoke3.png" alt="">
            </div>
            <div class="row py-2">
                <div class="col-md-4 position-relative py-3">
                    <div class="card card-plad wow bounceInDown" data-wow-delay="0.5s">
                        <div class="card-body py-5">
                            <h6 class="text-center">GAME CHANGER</h6>
                            <p class="text-center">
                                <img src="static/lp/images/icon/card1.png" alt="">
                            </p>
                            <p class="text-center">
                                Changing the World of Traditional Advertising to Onchain Interactive AdvertisingCopy
                            </p>

                        </div>
                    </div>
                    <div class="position-absolute stoke-card">
                        <img src="static/lp/images/stoke4.png" alt="">
                    </div>
                </div>
                <div class="col-md-4 py-3">
                    <div class="card card-plad wow bounceInUp" data-wow-delay="0.5s">
                        <div class="card-body py-5">
                            <h6 class="text-center">Trust Information collect </h6>
                            <p class="text-center">
                                <img src="static/lp/images/card-plad-2.png" alt="">
                            </p>
                            <p class="text-center">
                                Time transparency, interactive advertising information Onchain
                            </p>
                        </div>
                    </div>
                    <div class="position-absolute stoke-card">
                        <img src="static/lp/images/stoke4.png" alt="">
                    </div>
                </div>
                <div class="col-md-4 py-3">
                    <div class="card card-plad wow bounceInDown" data-wow-delay="0.5s">
                        <div class="card-body py-5">
                            <h6 class="text-center">Creators/Clients/Providers/Users</h6>
                            <p class="text-center">
                                <img src="static/lp/images/card-plad-3.png" alt="">
                            </p>
                            <p class="text-center">
                                The interaction between Creators/Clients/Providers/Users is all automated on Onchain with Smart contract
                            </p>
                        </div>
                    </div>
                    <div class="position-absolute stoke-card">
                        <img src="static/lp/images/stoke4.png" alt="">
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <img src="static/lp/images/stoke4.png" class="d-block w-50 mr-auto ml-auto" alt="">
            </div>
            <div class="frame">
                <img src="static/lp/images/Frame.png" alt="">
            </div>
        </div>
        <div class="position-absolute">
            <img src="static/lp/images/map.png" alt="">

        </div>

        <div class="Roadmap" id="Roadmap">
            <div class="text-center">
                <h2 class="text-white">ROADMAP</h2>
                <img src="static/lp/images/stoke3.png" alt="">
            </div>
            <div class="px-5 w-100">
                <div class="row ml-1">
                    <div class="col col-xs-12 roadmap-1 pt-5 mt-5">
                        <ul class="">
                            <li class="pb-2">
                                Web3 Milestone
                            </li>
                            <li class="pb-2">
                                UI/UX Design
                            </li>
                            <li class="pb-2">
                                Code Documentation
                            </li>
                            <li class="pb-2">
                                Token PreSale
                            </li>

                        </ul>
                    </div>
                    <div class="col col-xs-12 roadmap-1 pt-5 my-5">
                        <ul class="">
                            <li class="pb-2">
                                Whitepaper Release
                            </li>
                            <li class="pb-2">
                                Plat Token Testnet V1.0 Launch
                            </li>
                            <li class="pb-2">
                                The first BaGame release
                            </li>
                            <li class="pb-2">
                                IDE for Users
                            </li>
                        </ul>
                    </div>
                    <div class="col col-xs-12 roadmap-2 pt-5 my-2">
                        <ul class="">
                            <li class="pb-2">
                                Plat Middleware V1.0 Release
                            </li>
                            <li class="pb-2">
                                No Code Smart contract
                            </li>
                            <li class="pb-2">
                                BaGame convert function
                            </li>
                            <li class="pb-2">
                                Plat Token Testnet V2.0 Launch
                            </li>
                            <li class="pb-2">
                                BaGame store V1.0 Release
                            </li>
                            <li class="pb-2">
                                Public Sale
                            </li>

                        </ul>
                    </div>
                    <div class="col col-xs-12 roadmap-1 pt-5 my-5">
                        <ul class="">
                            <li class="pb-2">
                                Plat Middleware V2.0 Release

                            </li>
                            <li class="pb-2">
                                No Code Branding & NFTs <br/> adding
                            </li>
                            <li class="pb-2">
                                UI for Creators, Clients <br> and Providers
                            </li>

                        </ul>
                    </div>
                    <div class="col col-xs-12 roadmap-3  pt-5 ">
                        <ul class="pl-md-2">
                            <li class="pb-2">
                                Polkadot Crowdfunding
                            </li>
                            <li class="pb-2">
                                Mainnet Launch
                            </li>

                        </ul>
                    </div>

                </div>
            </div>



        </div>

    </article>
    <article id="frame-4">
        <div class="position-relative">
            <div class="px-5 position-relative">

                <div class="frame-3 ">
                    <img src="static/lp/images/Frame-3.png" class="w-100" alt="">
                </div>
                <div class="frame-3  position-absolute frame-4">
                    <img src="static/lp/images/Frame-4.png" class="img-fluid" alt="">
                </div>


            </div>
            <div class="frame-5  position-absolute">
                <img src="static/lp/images/Frame-5.png" class="img-fluid" alt="">
            </div>
        </div>


    </article>
    <article id='Team'>
        <div class="container">
            <div class="text-center">
                <h2 class="text-white pt-3">OUR TEAM MEMBER</h2>
                <img src="static/lp/images/stoke3.png" alt="">
                <p >Subtitle Subtitle Subtitle Subtitle Subtitle Subtitle Subtitle Subtitle  </p>
            </div>
            <div class="row">
                <div class="col-md-3 col-lg-3 py-2 " >
                    <div class="card member wow fadeIn"data-wow-delay="0.5s" >
                        <img class="card-img-top" src="static/lp/images/member/hungnv 1.png" alt="">


                        <div class="card-footer p-0 py-2" >
                            <div class="text-center   ">
                                <p class="m-0 pb-0">Nguyen Viet Hung</p>
                                <p class="text-muted text-white m-0 pb-0">Co-Founder and CEO</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 py-2">
                    <div class="card member wow fadeIn"data-wow-delay="1s">
                        <img class="card-img-top" src="static/lp/images/member/Nghi-Avatar 1.png" alt="">

                        <div class="card-footer p-0 py-2">
                            <div class="text-center   ">
                                <p class="m-0 pb-0">Itsuki Le</p>
                                <p class="text-muted text-white m-0 pb-0">Co-Founder and CTO</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 py-2">
                    <div class="card member wow fadeIn"data-wow-delay="1.5s">
                        <img class="card-img-top" src="static/lp/images/member/baonq 1.png" alt="">

                        <div class="card-footer p-0 py-2">
                            <div class="text-center   ">
                                <p class="m-0 pb-0">Nguyen Quang Bao</p>
                                <p class="text-muted text-white m-0 pb-0">Fullstack Developer</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 py-2">
                    <div class="card member wow fadeIn"data-wow-delay="2s">
                        <img class="card-img-top" src="static/lp/images/member/thao 1.png" alt="">

                        <div class="card-footer p-0 py-2">
                            <div class="text-center   ">
                                <p class="m-0 pb-0">Thảo Lam</p>
                                <p class="text-muted text-white m-0 pb-0">UI/UX Designer</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article id='adivision' class='position-relative py-2'>
        <div class="road-map-1 position-absolute">
            <img src="static/lp/images/road_map_1 1.png" alt="">

        </div>

        <div class="container pt-5">
            <div class="text-center">
                <h2 class="text-white">ADVISOR</h2>
                <img src="static/lp/images/stoke3.png" class="w-100" alt="">
            </div>
            <div class="row px-md-5">
                <div class="col-md-2 adivision w-sm-50 w-md-33 col-sm-6 col-lg-2 py-2">
                    <div class="adivision-item">
                        <img src="static/lp/images/logo-item1.png" alt="">
                    </div>
                </div>
                <div class="col-md-2 adivision w-sm-50 w-md-33 col-sm-6 col-lg-2 py-2">
                    <div class="adivision-item">
                        <img src="static/lp/images/logo-item-2.png" alt="">
                    </div>
                </div>
                <div class="col-md-2 adivision w-sm-50 w-md-33 col-sm-6 col-lg-2 py-2">
                    <div class="adivision-item">
                        <img src="static/lp/images/logo-item-3.png" alt="">
                    </div>
                </div>
                <div class="col-md-2 adivision w-sm-50 w-md-33  col-sm-6 col-lg-2 py-2">
                    <div class="adivision-item">
                        <img src="static/lp/images/logo-item-4.png" alt="">
                    </div>
                </div>
                <div class="col-md-2 adivision w-sm-50  w-md-33 col-sm-6 col-lg-2 py-2">
                    <div class="adivision-item">
                        <img src="static/lp/images/logo-item-5.png" alt="">
                    </div>
                </div>
                <div class="col-md-2 adivision w-sm-50 w-md-33  col-sm-6 col-lg-2 py-2">
                    <div class="adivision-item">
                        <img src="static/lp/images/logo-item-6.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article id='Resources' class='pt-5 position-relative'>

        <div class="container py-3">
            <div class="text-center">
                <h2 class="text-white text-uppercase">blog posts</h2>
                <img src="static/lp/images/stoke3.png" alt="">
            </div>
            <div class="row pt-3">
                <div class="col-md-4 col-lg-4">
                    <div class="card card-blog-post wow fadeIn" data-wow-delay="0.5s">
                        <img class="card-img-top" src="static/lp/images/blog-post-1.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title row">
                                <p class="text-small text-muted  col">03 June, 2021</p>
                                <p class="text-small text-muted col text-right">Posted By: Admin</p>
                            </h5>
                            <p class="card-text">
                                Bespoke crypto lending, trading, and custody for institutions
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="">Detail >> </a>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="card card-blog-post wow fadeIn" data-wow-delay="1s">
                        <img class="card-img-top" src="static/lp/images/blog-post-2.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title row">
                                <p class="text-small text-muted  col">03 June, 2021</p>
                                <p class="text-small text-muted col text-right">Posted By: Admin</p>
                            </h5>
                            <p class="card-text">
                                Bespoke crypto lending, trading, and custody for institutions
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="">Detail >> </a>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="card card-blog-post wow fadeIn" data-wow-delay="1.5s">
                        <img class="card-img-top" src="static/lp/images/blog-post-3.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title row">
                                <p class="text-small text-muted  col">03 June, 2021</p>
                                <p class="text-small text-muted col text-right">Posted By: Admin</p>
                            </h5>
                            <p class="card-text">
                                Bespoke crypto lending, trading, and custody for institutions
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="">Detail >> </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </article>

    <article id='subrice' class="pt-3 pb-2 position-relative">
        <div class="right position-absolute" style="width:50%;bottom:0;z-index: 9;right: 0;">
            <img src="static/lp/images/footer-right.png" alt="">
        </div>
        <div class="right position-absolute" style="width:50%;bottom:0;z-index: 9;left: 0;">
            <img src="static/lp/images/footer-left.png" alt="">
        </div>
        <div class="text-center">
            <h2 class="text-white pt-3">Subsribe Our Newsletter</h2>
            <p class="text-muted">Get reguler updates</p>
            <img src="static/lp/images/stoke3.png" alt="">
            <div class="w-50 mr-auto ml-auto pt-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control input" placeholder="Enter your email" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="input-group-text" id="Subsribe">Subsribe</button>
                    </div>
                </div>
            </div>


        </div>
        <div class="footer container  position-relative" style="padding-top: 5em;">

            <div class="row" >
                <div class="col-md-3 col-lg-3 py-2">
                    <img src="static/lp/images/logo.png" alt="">
                    <p class="pt-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.
                    </p>
                    <div class="row">
                        <div class="col">
                            <div class="icon-footer">
                                <a href="https://github.com/" class="lni-facebook-filled icon-social"></a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="icon-footer">
                                <a href="https://twitter.com/" class="lni-twitter-filled icon-social"></a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="icon-footer">
                                <a href="https://" class="lni-instagram-filled icon-social"></a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="icon-footer">
                                <a href="https://" class="lni-linkedin-original icon-social"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3  py-2">
                    <h2>Quick link</h2>
                    <p class="pt-2">
                        Road Map
                    </p>
                    <p class="pt-2">
                        Privacy Policay
                    </p>
                    <p class="pt-2">
                        Refund Policy Terms of Service
                    </p>
                    <p class="pt-2">
                        Pricing
                    </p>
                </div>
                <div class="col-md-3 col-lg-3  py-2">
                    <h2>Resources</h2>
                    <p class="pt-2">
                        Home
                    </p>
                    <p class="pt-2">
                        Page
                    </p>
                    <p class="pt-2">
                        Portfolio
                    </p>
                    <p class="pt-2">
                        Blog Contact
                    </p>
                </div>
                <div class="col-md-3 col-lg-3  py-2">
                    <h2>Contact Us</h2>
                    <p class="pt-2">
                        +809272561823
                    </p>
                    <p class="pt-2">
                        info@gmail.com
                    </p>
                    <p class="pt-2">
                        www.yourweb.com
                    </p>
                    <p class="pt-2">
                        123 Stree New York City, United States Of America 750
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <h6 class="text-center text-white pt-2">Copyright © 2021, Created by VAIX</h6>
        <div id="particles-2" class="particles"></div>

    </article>
    <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

    <script src="static/lp/js/jquery-3.6.0.min.js"></script>
    <script src="static/lp/bootstrap4/js/bootstrap.bundle.js"></script>
    <script src='https://cdn.rawgit.com/matthieua/WOW/1.0.1/dist/wow.min.js'></script>
    <script src="static/lp/js/particles.min.js"></script>
    <script src="static/lp/js/app.js"></script>

</body>
</html>
