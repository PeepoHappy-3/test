export class Form {
  constructor(config) {
    this._formSelector = config.formSelector;
    this._inputSelector = config.inputSelector;
    this._submitSelector = config.submitSelector;
    this._inputErrorSelector = config.inputErrorSelector;
    this._errorActiveSelector = config.errorActiveSelector;   
  }
  _showError(error, input) {
    error.classList.add(this._errorActiveSelector);
    error.textContent = input.validationMessage;
    input.classList.add(this._inputErrorSelector);
  }

  _hideError(error, input) {
    error.classList.remove(this._errorActiveSelector);
    error.textContent = '';
    input.classList.remove(this._inputErrorSelector);
  }
  _hasInvalidInput(inputList) {
    return inputList.some((input) => {
      return !input.validity.valid;
    });
  }
  _isValid(formElement, inputElement) {
    const error = formElement.querySelector(`#${inputElement.id}-error`);
    if (!inputElement.validity.valid) {
      this._showError(error, inputElement);
    } else {
      this._hideError(error, inputElement);
    }
  }
  _toggleSubmit(formElement, inputList) {
    const submit = formElement.querySelector(this._submitSelector);
    if (this._hasInvalidInput(inputList)) {
      submit.setAttribute('disabled', true);
    } else submit.removeAttribute('disabled');
  }

  runValidation() {
    const formElement = document.querySelector(this._formSelector);    
    const inputList = Array.from(formElement.querySelectorAll(this._inputSelector));
    inputList.forEach((inputElement) => {
      inputElement.addEventListener('input', () => {
        this._isValid(formElement, inputElement);
        this._toggleSubmit(formElement, inputList);
      });
    })
  }
  resetValidation() {
    const form = document.querySelector(this._formSelector);
    const inputList = Array.from(form.querySelectorAll(this._inputSelector));
    const submit = form.querySelector(this._submitSelector);
    inputList.forEach((input) => {
      const error = form.querySelector(`#${input.id}-error`);     
      input.classList.remove(this._inputErrorSelector);
      error.classList.remove(this.__errorActiveSelector);
      submit.setAttribute('disabled', true);
    });
  }
  setSubmit(handler) {
    const form = document.querySelector(this._formSelector);
    form.addEventListener('submit', (e) => {
      e.preventDefault();      
        handler(this._getInputVaules());
    });
  }
  _getInputVaules() {
    const form = document.querySelector(this._formSelector);
    this._fileInput = form.querySelector(`${this._inputSelector}-file`);
    const formData = new FormData(form);   
    return formData;
  }
  clearForm() {
    const form = document.querySelector(this._formSelector);  
    form.reset(); 
  }
}