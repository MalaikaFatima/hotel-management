<!-- Basic Meta Tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">

<!-- Site Metas -->
<title>Keto Hotel</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicon -->
<link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/gif" />

<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">

<!-- External CSS -->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Custom Styles -->
<style>
   /* ================================
      GLOBAL COLOR SCHEME
      ================================ */
   :root {
       --primary-color: #1a73e8;        /* Change this for main color */
       --secondary-color: #f4511e;      /* Accent color */
       --heading-color: #19110b;        /* All headings color */
       --text-color: #2f2d2d;           /* Body text */
       --dark-bg: #19110b;              /* Dark backgrounds */
   }

   /* ================================
      NAVIGATION & LOGO STYLES
      ================================ */
   
   /* Prevent navigation text wrapping */
   .navigation .navbar-nav .nav-link,
   .navigation .navbar-nav .btn {
       white-space: nowrap;
       font-size: 14px;
       padding: 8px 12px;
   }

   .navigation .navbar-nav .nav-item {
       padding: 0 3px;
   }

   /* Reduce button padding */
   .navigation .btn {
       padding: 6px 15px;
       font-size: 14px;
   }

   /* Logo size control */
   .logo_section .logo img {
       max-width: 140px;
       max-height: 70px;
       width: auto;
       height: auto;
       object-fit: contain;
   }

   /* Adjust logo container alignment */
   .logo_section .center-desk {
       display: flex;
       align-items: center;
       height: 100%;
   }

   .logo_section .logo {
       display: flex;
       align-items: center;
   }

   /* ================================
      GLOBAL HEADING COLORS
      ================================ */
   
   /* All section headings */
   .titlepage h2 {
       color: var(--heading-color) !important;
   }

   /* Colored part of headings */
   .titlepage h2 span {
       color: var(--primary-color) !important;
   }

   /* All HTML headings */
   h1, h2, h3, h4, h5, h6 {
       color: var(--heading-color);
   }

   /* Specific section headings */
   .about .titlepage h2,
   .our_room .titlepage h2,
   .gallery .titlepage h2,
   .blog .titlepage h2,
   .contact .titlepage h2 {
       color: var(--heading-color) !important;
   }

   /* Underline after headings */
   .titlepage h2::after {
       background: var(--primary-color) !important;
   }

   
   /* ================================
      BUTTONS & LINKS
      ================================ */
   
   .read_more,
   .btn-primary {
       background: var(--primary-color) !important;
       border-color: var(--primary-color) !important;
   }

   .read_more:hover,
   .btn-primary:hover {
       background: var(--secondary-color) !important;
       border-color: var(--secondary-color) !important;
   }

   /* Navigation hover */
   .navigation .nav-link:hover {
       color: var(--primary-color) !important;
   }

   /* ================================
      LOADER STYLING
      ================================ */
   
   .loader_bg {
       position: fixed;
       z-index: 9999999;
       background: #fff;
       width: 100%;
       height: 100%;
       display: flex;
       align-items: center;
       justify-content: center;
   }

   .loader {
       text-align: center;
   }
</style>