// require('./bootstrap');
import './bootstrap'
import Vue from 'vue'
import TweetLike from './components/TweetLike'
const app = new Vue({
  el: '#app',
  components: {
    TweetLike,
  }
})
