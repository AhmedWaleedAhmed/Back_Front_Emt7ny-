import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AddQuestionComponent } from './add-question/add-question.component';
import { LoginComponent } from './login/login.component';
import { PreviewComponent } from './preview/preview.component';
import { ProfileComponent } from './profile/profile.component';
import { CanActivate } from '@angular/router';
import { BeforeLoginService } from './Services/before-login.service';
import { AfterLoginService } from './Services/after-login.service';

const routes: Routes = [
  {path: '', component: LoginComponent , canActivate :[BeforeLoginService]},
  {path: 'AddQuestion', component: AddQuestionComponent , canActivate: [AfterLoginService] },
  {path: 'previewExam/:username/:id', component: PreviewComponent , canActivate: [AfterLoginService] },
  {path: 'profile/:username', component: ProfileComponent , canActivate: [AfterLoginService] }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
