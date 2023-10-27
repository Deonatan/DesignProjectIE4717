class Header extends HTMLElement {
    constructor() {
      super();
    }
  
    connectedCallback() {
      this.innerHTML = `
        <style>
          
        </style>
        <header>
          <nav>
            <ul>
              
            </ul>
          </nav>
        </header>
      `;
    }
  }
  
  customElements.define('custom-navbar', Header);