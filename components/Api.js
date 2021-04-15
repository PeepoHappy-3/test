export class Api{
  constructor(conf) {
    this._baseUrl = conf.baseUrl;
  }

  postForm(data) {    
    return fetch(`${this._baseUrl}/post_error.php`, {
      method: 'POST',  
      body: data,  
    }).then(res => {
      if (res.ok) {
        return res.json();
      }
      return Promise.reject(new Error(`Ошибка ${res.status}`));
    })
  }
}