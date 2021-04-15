import { Form } from '../components/Form.js';
import { Api } from '../components/Api.js';
import { Popup } from '../components/Popup.js';

const conf = {
  formSelector: '.test__form',
  inputSelector: '.test__input',
  submitSelector: '.test__submit',
  inputErrorSelector: 'test__input-error',
  errorActiveSelector: 'test__text-error_visible',
}

const apiConf = {
  baseUrl: 'php'
};

const popupConf = {
  popup: document.querySelector('.popup'),
  openClass: 'popup_visible',
  button: '.popup__button',
  closeButton: '.popup__close-button'
}

const api = new Api(apiConf);
const form = new Form(conf, submitForm);
const popup = new Popup(popupConf);

function submitForm(data) {
  api.postForm(data).then(res => {
    console.log(res);
    popup.open();
  })
    .catch(err => {
    console.log(err);
  }).finally(()=>{  
    form.resetValidation();
    form.clearForm();
  });
}
form.runValidation();
form.setSubmit(submitForm);
popup.setCloseListeners();


