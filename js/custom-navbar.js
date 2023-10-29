class Header extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    const type = this.getAttribute("type");
    let content = `
    <style>
    .navbar {
      width: 100%;
      background-color: #435334;
      height: 80px;
      color: #fff;
    }

    .logo {
        display: block;
        color: #fff;
        text-decoration: none;
        float: left;
        height: 50px;
        padding: 15px 40px;
        font-size: 1.5em;
        line-height: 50px;
    }

    .navbar .nav {
        margin: 0;
        padding: 0;
        float: right;
        list-style-type: none;
    }

    .navbar .nav li.nav-item {
        float: left;
    }

    .navbar .nav li.nav-item > a {
        display: inline-block;
        padding: 15px 20px;
        height: 50px;
        line-height: 50px;
        color: #fff;
        text-decoration: none;
    }

    .navbar .nav li.nav-item > a:hover {
        background-color: #2c3623;
    }

    .dropdown a:focus {
        background-color: #2c3623;
    }

    .dropdown a:focus ~ .dropdown-container {
        max-height: 500px;
        transition: max-height 0.5s ease-in;
        -webkit-transition: max-height 0.5s ease-in;
        -moz-transition: max-height 0.5s ease-in;
    }

    .dropdown-container {
        position: absolute;
        top: 80px;
        max-height: 0;
        overflow: hidden;
        background: #435334;
        color: #fff;
        right: 0; /* Change 'right' to '0' to align the dropdown to the left */
    }

    .dropdown-container a {
        color: #fff;
        text-decoration: none;
    }

    .dropdown-menu {
        margin: 0;
        padding: 0;
        list-style-type: none;
        text-align: left; /* Align the text inside the dropdown menu to the left */
    }

    .dropdown-menu li a {
        display: inline-block;
        min-width: 200px;
        padding: 15px 20px;
        border-bottom: 1px solid #333;
    }

    .dropdown-menu li a:hover {
        text-decoration: none;
        background: #2c3623;
    }

    .content {
        padding: 40px;
    }
    </style>
  </head>
  <body>
    <nav class="navbar">
    `;
    if (type === "parent") {
      content += `<img class="logo" src="public/movieverse-logo.png">`;
    } else if (type === "child") {
      content += `<img class="logo" src="../public/movieverse-logo.png">`;
    }
    content += `
    <ul class="nav" id="primary-nav">
    <li class="nav-item"><a href="">Home</a></li>
    <li class="nav-item"><a href="">Theatres</a></li>
    <li class="nav-item dropdown">
            <a href="#">👤</a>
            <div class="dropdown-container">
                <div class="dropdown-inner">
                    <ul class="dropdown-menu">
                        <li class="dropdown-menu-item"><a href="#">Login</a></li>
                        <li class="dropdown-menu-item"><a href="#">Register</a></li>
                        <li class="dropdown-menu-item"><a href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
      </li>
  </ul>
</nav>
</body>
    `;
    this.innerHTML = content;
  }
}

customElements.define("custom-navbar", Header);
