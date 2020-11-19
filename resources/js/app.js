// require('./bootstrap');
import './bootstrap'
import Vue from 'vue'
import TweetLike from './components/TweetLike'
import TweetTagsInput from './components/TweetTagsInput'
import FollowButton from './components/FollowButton'
const app = new Vue({
  el: '#app',
  components: {
    TweetLike,
    TweetTagsInput,
    FollowButton,
  }
})
