export class Popup{
  constructor(conf) {
    this._popup = conf.popup;
    this._openClass = conf.openClass;
    this._closeButton = conf.closeButton;
    this._button = conf.button;
    this._header = conf.header;
    this._icon = conf.icon;
    this._handleOverlayClose = this._handleOverlayClose.bind(this);
    this._handleEscClose = this._handleEscClose.bind(this);
  }
  open() {
    this._popup.classList.add(this._openClass);
    document.addEventListener('keyup', this._handleEscClose);
  }
  close() {
    this._popup.classList.remove(this._openClass);
    document.removeEventListener('keyup', this._handleEscClose);
  }
  _handleOverlayClose(e) {
    if (e.target.classList.contains(this._openClass)) {
        this.close();
    }
  }
  _handleEscClose(e) {
    if (e.key == 'Escape') {
      this.close();
    }
  }
  setCloseListeners() {
    const closeButton = this._popup.querySelector(this._closeButton);
    const button = this._popup.querySelector(this._button);
    this._popup.addEventListener('click', this._handleOverlayClose)
    closeButton.addEventListener('click', () => {
      this.close();
    });
    button.addEventListener('click', () => {
      this.close();
    });
  }

  _setMessage(message) {
    const header = this._popup.querySelector(this._header);
    header.textContent = message;
  }

  _setIcon(src) {
    const icon = this._popup.querySelector(this._icon);
    icon.src = src;
  }
  setContent(message, icon) {
    this._setMessage(message);
    this._setIcon(icon);   
  }
}