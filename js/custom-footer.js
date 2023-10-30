class Footer extends HTMLElement {
    constructor() {
      super();
    }
  
    connectedCallback() {
      const type = this.getAttribute("type");
      let content = `
      <style>
      .footer-container{
        margin-top:30px;
        background-color: #2c3623;
        text-align:center;
        color:white;
        height:50px;
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
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
            <a id='mail-href' href="mailto:movieverse@email.com">movieverse@email.com</a>
        </i></small>
        </div>
        </footer>
  </body>
      `;
      this.innerHTML = content;
    }
  }
  
  customElements.define("custom-footer", Footer);
  