<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="BPS, Badan Pusat Statistik, Lhokseumawe, Indonesia, Sensus Penduduk">
<meta name="description" content="Aplikasi Geolocation BPS (Badan Pusat Statistik)">
<meta name="robots" content="noindex,nofollow">
<!-- <link rel="canonical" href="https://www.wrappixel.com/templates/Flexy-admin-lite/" /> -->
<!-- Favicon icon -->
<link rel="icon" type="image/ico" sizes="16x16" href="../public/favicon.ico">
<!-- Custom CSS -->
<link href="../public/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
<link href="../public/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="../public/css/style.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/a341d667ca.js" crossorigin="anonymous"></script>
<script src="../public/js/sweetalert.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    ::-webkit-scrollbar {
        height: 6px;
        width: 8px;
        border: 1px solid #d5d5d5;
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.3);
        background: #eeeeee;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 10px;
        /* background-color: rgba(26, 155, 252, 0.5); */
        background: #b0b0b0;
    }

    ::-webkit-scrollbar-thumb:hover {
        border-radius: 5px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        /* background-color: rgba(0, 121, 214, 0.5); */
        background-color: rgba(220, 220, 220, 1);
    }

    @media only screen and (max-width: 993px) {
        ::-webkit-scrollbar {
            width: 5px;
            background-color: #ffffff;
        }
    }





    @media only screen and (min-width: 0) {
        .show-sidebar .left-sidebar .sticky {
            position: fixed;
            top: 5px;
            left: 0;
            width: 259px;
        }
    }

    @media only screen and (min-width: 768px) {
        /* .topbar .navbar .navbar-collapse {
            position: fixed;
        } */

        .left-sidebar .sticky {
            display: inline-block;
            position: fixed;
            top: 5px;
            left: 0;
            width: 64px;
        }

        .left-sidebar .sticky:hover {
            width: 259px;
        }
    }

    @media only screen and (min-width: 1170px) {
        .left-sidebar .sticky {
            width: 259px;
        }

        .sticky,
        .sidebar-nav,
        .sidebarnav {
            padding: 0;
        }

        .sidebar-nav {
            width: 100%;
        }
    }

    .logout {
        background-color: #fc4b6c;
    }

    .logout button {
        color: white;

    }

    .logout button:hover {
        color: #fc4b6c;
    }

    .logout button:active {
        color: white;
    }

    /* li#logout a:hover {
        color: black;
    } */

    .tooltiphtml {
        position: relative;
        display: inline-block;
        /* border-bottom: 1px dotted black; */
    }

    .tooltiphtml .tooltiptext {
        visibility: hidden;
        width: 100px;
        background-color: rgba(0, 0, 0, .4);
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;

        /* Position the tooltip */
        position: absolute;
        z-index: 1;
        bottom: 100%;
        left: 70%;
        margin-left: -60px;
    }

    .tooltiphtml:hover .tooltiptext {
        visibility: visible;
    }

    /* .logout-item button {
        border: 0;
        background-color: white;
    }

    .logout-item {
        border: 0 !important;
    }

    .logout-item button {
        color: white;
        background-color: #fc4b6c;
    } */

    /* * {
        border-radius: 0 !important;
    } */

    .logout-item>button:hover,
    .logout-item>button:visited,
    .logout-item>button:focus {
        color: #555555 !important;
        background-color: #e7e7e7 !important;
        border: 0 !important;
    }

    .logout>button:hover,
    .logout>button:visited,
    .logout>button:focus {
        color: #fc4b6c !important;
        background-color: #e7e7e7 !important;
        border: 0 !important;
    }


    .gambar-home:hover {
        cursor: pointer;
        color: #555555;
    }
</style>