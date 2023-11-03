class Header extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    const type = this.getAttribute("type");
    const customNavbarStyle = `
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
    }

    .navbar {
    overflow: hidden;
    background:linear-gradient(to bottom, #000000, #0d0207, #130411, #160719, #140c22, #110e25, #0c0f29, #04112c, #040f2b, #040d29, #030b28, #030827);
    }

    .navbar a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    line-height: 80px; 
    padding: 0 16px; 
    text-decoration: none;
    }

    .dropdown {
    float: right;
    overflow: hidden;
    line-height: 80px;
    }

    .dropdown .dropbtn {
    font-size: 16px;  
    border: none;
    outline: none;
    color: white;
    padding: 30px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;

    }

    .navbar a:hover, .dropdown:hover .dropbtn {
    background-color: #008080;
    }

    .logo{
        float:left;
        height:80px;
        width:120px;
        margin-left:20px;
    }

    .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 80px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    right:0;
    }

    .dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    line-height: 20px;
    }

    .dropdown-content a:hover {
    background-color: #ddd; 
    }

    .dropdown:hover .dropdown-content {
    display: block;
    }
    </style>
    `;
    let content = customNavbarStyle;
    let path = "";
    if (type === "child") {
      path = "../";
    }
    content += `
    <body>
        <div class="navbar">
        <img class="logo" src="${path}public/movieverse-logo.png"/>
        <a href="${path}index.php">Movies</a>
        <a href="${path}php/theatre.php">Theatre</a>
        <a href="${path}php/transaction_history.php">Transactions</a>
        <a href="${path}php/enquiry.php">Enquiry</a>
        <div class="dropdown">
            <button class="dropbtn">    
            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
            <a href="${path}html/login.html">Login</a>
            <a href="${path}html/register.html">Register</a>
            <a href="${path}php/logout.php">Logout</a>
            </div>
        </div> 
        </div>
    </body>
    `;
    this.innerHTML = content;
  }
}

customElements.define("custom-navbar", Header);
