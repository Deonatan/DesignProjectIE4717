class Footer extends HTMLElement {
    constructor() {
      super();
    }
  
    connectedCallback() {
      const type = this.getAttribute("type");
      let content = `
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <style>
      .footer-container{
        // margin-top:30px;
        background-color: #060E2A;
        text-align:center;
        color:white;
        height:80px;
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
      }

      .icon i {
        color: white;
      }

      a{
        margin-top:5px;
      }

      #mail-href{
        color:white
      }
      </style>
    </head>
    <body>
        <footer>
        <div class='footer-container'>
        <small><i>
            Copyright &copy; 2023 Movie Verse<br>
            <a id='mail-href' href="mailto:movieverse@email.com">movieverse@email.com</a><br>
            <div style='margin-top:5px;'>
            <a href="#" class="icon"><i class="fab fa-facebook"></i></a>
            <a href="#" class="icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
            </div>
        </i></small><br>
        </div>
        </footer>
  </body>
      `;
      this.innerHTML = content;
    }
  }
  
  customElements.define("custom-footer", Footer);
  