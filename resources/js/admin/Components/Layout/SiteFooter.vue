<template>
  <footer class="page-footer small p-2">
    <p class="mb-0" v-if="filled(author)" v-cloak>
      {{ year }} © {{ author }}.
      Design By <span v-if="blank(link)">{{ designer }}</span>
      <a v-else :href="link" target="_blank">{{ designer }}</a></p>
  </footer>
</template>

<script>
export default {
  name: "SiteFooter",
  props: {
    footerUrl: String
  },
  data() {
    return {
      year: null,
      author: null,
      designer: null,
      link: null
    }
  },
  mounted() {
    axios
      .get(this.footerUrl)
      .then((response) => {
        this.year = response.data.data.year;
        this.author = response.data.data.author;
        this.designer = response.data.data.designer;
        this.link = response.data.data.link;
      });
  }
}
</script>
