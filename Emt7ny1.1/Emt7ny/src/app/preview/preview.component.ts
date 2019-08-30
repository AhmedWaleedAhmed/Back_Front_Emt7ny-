import { Component, OnInit } from '@angular/core';
import { AuthService } from '../Services/auth.service';
import {  Router } from '@angular/router';
import { TokenService } from '../Services/token.service';

@Component({
  selector: 'app-preview',
  templateUrl: './preview.component.html',
  styleUrls: ['./preview.component.css']
})
export class PreviewComponent implements OnInit {

  constructor(
    private router: Router ,
    private Auth: AuthService,
    private token:TokenService,
  ) { }

  ngOnInit() {
  }

  logout(event : MouseEvent){
    event.preventDefault();
    this.token.remove();
    this.Auth.changeAuthStatus(false);
    this.router.navigateByUrl('');
  }

}
