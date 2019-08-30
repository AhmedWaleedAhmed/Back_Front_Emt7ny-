import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class JarwisService {

  // this class for handling the requests from the login.component.ts or any other one 
  constructor(private http:HttpClient )  { }

  signup(data){
    return this.http.post('http://localhost:8000/api/signup',data)  
  }
  login(data){
    return this.http.post('http://localhost:8000/api/login',data)
  }

  sendpasswordresetlink(data){
    return this.http.post('http://localhost:8000/api/sendPasswordResetLink',data)
  }

  changePassword(data){
    return this.http.post('http://localhost:8000/api/resetPassword',data)
  }
}
