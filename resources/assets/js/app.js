import axios from 'axios';
import Vue from 'vue';

window.onload = function () {
      var app = new Vue({
          el: '#app',
          data: {
              comments: {},
              commentBox: '',
              post: post,
              user: {}
          },
          mounted() {
              this.getAuth();
              this.listen();
          },
          methods: {
              getComments() {
                  axios.get('/api/posts/' + this.post.id + '/comments')
                      .then((response) => {
                          this.comments = response.data;
                      })
              },
              getAuth() {
                  axios.get('/user/auth')
                      .then((response) => {
                          this.user = response.data;
                      })
                  this.getComments();
              },
              postComment() {
                  axios.post('/api/posts/' + this.post.id + '/comment', {
                          api_token: this.user.api_token,
                          body: this.commentBox
                      })
                      .then((response) => {
                          this.comments.unshift(response.data);
                          this.commentBox = '';
                      })
              },
              listen() {
                  Echo.private('post.' + this.post.id)
                      .listen('NewComment', (comment) => {
                          this.comments.unshift(comment);
                      })
              }
          }
      });
  }