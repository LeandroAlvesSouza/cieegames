import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

interface Game {
  name: string;
  description: string;
  image_url: string;
  created_at: Date;
  category_description: string;
  developerdescription: string;
}

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.css']
})
export class AppComponent implements OnInit {
 
    title = 'cieegames'; 
  
  games!: Game[];

  constructor(private http: HttpClient) {}

  ngOnInit() {
    this.http.get<Game[]>('http://localhost/games/cieegames/src/app/api.php').subscribe(games => {
      this.games = games;
    });
  }
}
