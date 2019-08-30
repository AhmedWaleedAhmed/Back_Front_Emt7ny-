import { Component, OnInit } from '@angular/core';
import { JarwisService } from 'src/app/Services/jarwis.service';
import { TokenService } from '../Services/token.service';
import { Router } from '@angular/router';
import { AuthService } from '../Services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  /**
   * For the forget password items
   */
  isShown: boolean = false;
  /**
   * For choosing between signup or login
   */
  login: boolean = true;
  constructor(
    private jarwis:JarwisService ,
    private token:TokenService,
    private router: Router ,
    private Auth: AuthService,
  ) { }

  ngOnInit() {
  }
  forgetPassword() {
    this.isShown = true;
  }
  chooseLogin() {
    this.login = true;
    this.isShown = false;
    document.getElementById("choose-login").style.backgroundColor = 'rgb(43, 164, 204)';
    document.getElementById("choose-signup").style.backgroundColor = '#343a40';
    this.form.email='';
    this.form.password='';
  }
  chooseSignup() {
    this.login = false;
    document.getElementById("choose-login").style.backgroundColor = '#343a40';
    document.getElementById("choose-signup").style.backgroundColor = 'rgb(43, 164, 204)';
    this.form_signup.email='';
    this.form_signup.name='';
    this.form_signup.password='';
    this.form_signup.password_confirmation='';
  }

  /*
  *   login handling by ahmed waleed 
  */
  public error =null;
  
  public form={
    email:null,
    password:null
  };
  onSubmit(){
    this.jarwis.login(this.form).subscribe(
      data => this.handelResponse(data),
      error => this.handelError(error)
    );
  }

  handelResponse(data){
    this.token.handel(data.access_token);
    this.Auth.changeAuthStatus(true);
    this.router.navigateByUrl('/profile/:username');
  }

  handelError(error){
    this.error=error.error.error;
  } 


  /*
  *  sign up handling by ahmed waleed 
  */
  public error_2 =[];

  public form_signup={
    email:null,
    password:null,
    name:null,
    password_confirmation:null,
  };

  onSubmit_signup(){
    this.jarwis.signup(this.form_signup).subscribe(
        data => this.handelResponse_2(data),
        error_2 => this.handelError_2(error_2)
      );
  }
  handelResponse_2(data){
    this.token.handel(data.access_token);
    this.chooseLogin();
    this.router.navigateByUrl('/login');
  }
  handelError_2(error){
    this.error=error.error.errors;
  }

}
