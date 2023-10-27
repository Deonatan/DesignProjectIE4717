class Header extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
    <style>
    .custom-navbar {
        background-color: #435334;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 0px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      }
      
      .custom-navbar ul {
        list-style: none;
        margin: 0;
        padding: 0;
      }
      
      .custom-navbar li {
        display: inline;
        margin: 0 15px;
        font-size: 18px;
      }
      
      .custom-navbar a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
      }
      
      .custom-navbar a:hover {
        color: #f39c12; /* Change the color on hover to your preference */
        transition: color 0.3s;
      }

      img {
        width: 80px;
        height: 50px;
        margin-left: 20px;
      }
      
    </style>
    <header>
    <nav class="custom-navbar">
    <img src="public/movieverse-logo.png">
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/movies">Movies</a></li>
      <li><a href="/theatres">Theatres</a></li>
    </ul>
  </nav>
    </header>
  `;
  }
}

customElements.define("custom-navbar", Header);