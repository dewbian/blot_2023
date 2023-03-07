class MyUploadAdapter {
    // // ...

    // // Starts the upload process.
    // upload() {
    //     console.log("dkdkdkdkd");
    //     return this.loader.file
    //         .then( file => new Promise( ( resolve, reject ) => {
    //             this._initRequest();
    //             this._initListeners( resolve, reject, file );
    //             this._sendRequest( file );
    //         } ) );
    // }

    // // Aborts the upload process.
    // abort() {
    //     if ( this.xhr ) {
    //         this.xhr.abort();
    //     }
    // }

    // // ...

    constructor(loader) {
        this.loader = loader
        console.log("constructor====>["+ loader+ "]")
      }
    
      upload() { 
        console.log("upload")
        return this.loader.file.then(
          (file) =>
            new Promise((resolve, reject) => {
              this._initRequest()
              this._initListeners(resolve, reject, file)
              this._sendRequest(file)
            })
        )
      }
    
      _initRequest() {
        const xhr = (this.xhr = new XMLHttpRequest())
        
        // 파일업로드를 처리할 경로를 작성해 준다.
        xhr.open('POST', '/ck-editor/image/upload', true) 
     
        //laravel 용 토큰을 함께 보내준다. (로그인 한 유저만 허용)
        xhr.setRequestHeader(
         'X-CSRF-TOKEN',
         document.querySelector('meta[name="csrf-token"]').getAttribute('editor')
        )
        console.log("_initRequest")
        xhr.responseType = 'json'
      }
    
      _initListeners(resolve, reject, file) {
        console.log("_initListeners");
        const xhr = this.xhr
        const loader = this.loader
        const genericErrorText = '파일업로드 실패 - 관리자에게 문의하세요.'
    
        xhr.addEventListener('error', (err) => {
          console.log("에러1---->["+err+"]")
          reject(genericErrorText)
        })
        xhr.addEventListener('abort', () => reject())
        xhr.addEventListener('load', () => {

          console.log("로드로드") 
          const response = xhr.response 
          if (!response || response.error) {
            return reject(
              response && response.error ? response.error.message : genericErrorText
            )
          }
    
          resolve({
            default: response.url, //업로드된 파일 주소
          })
        })
      }
    
      _sendRequest(file) {
        const data = new FormData()
        data.append('upload', file)
        console.log("_sendRequest")
        console.log(file)
        this.xhr.send(data)
      }
  
      abort() {
        // Reject the promise returned from the upload() method.
        console.log("abort");
        server.abortUpload();
    }
  



}