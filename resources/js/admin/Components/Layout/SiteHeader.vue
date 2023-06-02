<template>
  <div class="page-header fixed-top">
    <h1 class="navbar-brand left-width pl-3 navbar navbar-expand-lg">
      <a class="font-weight-bold text-uppercase" :href="systemUrl">
        <img class="mr-1 align-middle" :src="systemLogo" alt="">
      </a>
    </h1>
    <button class="btn btn-link toggle-left-nav-btn no-decoration" type="button"
            @click="$emit('toggle-menu', !menuActive)">
      <span class="text-hide">{{ array_get(trans, 'ui.layout.menu') }}</span><span class="line"></span>
    </button>
    <div class="top-right pr-2 mt-1">
      <div class="d-inline-block dropdown globe" v-if="layoutLanguages.length > 1">
        <button class="btn btn-link text-secondary dropdown-toggle px-2" id="menu-globe" type="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="icon-globe h4"></i><span class="text-hide">{{ array_get(trans, 'ui.layout.language') }}</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="menu-globe">
          <a v-for="language in layoutLanguages"
             class="dropdown-item" :class="{'active': language.id === layoutLanguage}"
             :href="language.id === layoutLanguage ? '#' : language.url">
            <i class="img-thumbnail flag flag-icon-background" :class="[language.icon_class]"></i><!--
         --><span>{{ language.title }}</span>
          </a>
        </div>
      </div>
      <div class="d-inline-block dropdown globe">
        <button class="btn btn-link text-secondary dropdown-toggle px-2" id="menu-profile" type="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="icon-user h4"></i><span class="text-hide">{{ array_get(trans, 'ui.layout.account') }}</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="menu-profile">
          <a class="dropdown-item" :href="profileUrl">
            <i class="icon-vcard"></i><span>{{ array_get(trans, 'ui.layout.profile') }}</span>
          </a>
          <a class="dropdown-item" :href="logoutUrl">
            <i class="icon-log-out"></i><span>{{ array_get(trans, 'ui.layout.logout') }}</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Base64 } from "js-base64";

export default {
  name: "SiteHeader",
  props: {
    headerUrl: String,
    menuActive: Boolean,
    trans: Object
  },
  data() {
    return {
      siteTitle: '',
      systemUrl: '',
      systemLogo: '',
      profileUrl: '',
      logoutUrl: '',
      layoutLanguages: [],
      layoutLanguage: document.documentElement.lang
    }
  },
  mounted() {
    axios
      .get(this.headerUrl + '?current=' + Base64.encode(window.location.href))
      .then((response) => {
        this.siteTitle = response.data.data.siteTitle;
        this.systemUrl = response.data.data.systemUrl;
        this.systemLogo = response.data.data.systemLogo;
        this.profileUrl = response.data.data.profileUrl;
        this.logoutUrl = response.data.data.logoutUrl;
        this.layoutLanguages = response.data.data.layoutLanguages;
      });
  }
}
</script>
