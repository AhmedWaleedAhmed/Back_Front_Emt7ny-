import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AddQuestionComponent } from './add-question/add-question.component';
import { LoginComponent } from './login/login.component';
import { PreviewComponent } from './preview/preview.component';
import { ProfileComponent } from './profile/profile.component';

const routes: Routes = [
  {path: '', component: LoginComponent},
  {path: 'AddQuestion', component: AddQuestionComponent},
  {path: 'previewExam/:username/:id', component: PreviewComponent},
  {path: 'profile/:username', component: ProfileComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
