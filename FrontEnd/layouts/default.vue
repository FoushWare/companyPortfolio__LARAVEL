
<template>
  <div class="layout">
    <Layout>
      <Header>
        <Menu mode="horizontal" theme="dark" active-name="1">
          <div class="layout-logo"></div>
          <div class="layout-nav">
            <MenuItem name="1">
              <NuxtLink to="/">
                <Icon type="ios-navigate"></Icon>Home
              </NuxtLink>
            </MenuItem>
            <MenuItem name="2">
              <NuxtLink to="/">
                <Icon type="ios-keypad"></Icon>Services
              </NuxtLink>
            </MenuItem>

            <MenuItem name="3">
              <NuxtLink to="/teams">
                <Icon type="ios-analytics"></Icon>Teams
              </NuxtLink>
            </MenuItem>

            <MenuItem name="4">
              <NuxtLink to="/">
                <Icon type="ios-paper"></Icon>Our Works
              </NuxtLink>
            </MenuItem>

            <MenuItem name="5">
              <NuxtLink to="/">
                <Icon type="ios-paper"></Icon>About Us
              </NuxtLink>
            </MenuItem>

            <MenuItem name="6">
              <NuxtLink to="/">
                <Icon type="ios-paper"></Icon>Privacy
              </NuxtLink>
            </MenuItem>

            <MenuItem name="7">
              <NuxtLink to="/">
                <Icon type="ios-paper"></Icon>Terms And Conditons
              </NuxtLink>
            </MenuItem>

            <MenuItem name="8">
              <NuxtLink to="/clients">
                <Icon type="ios-paper"></Icon>Clients
              </NuxtLink>
            </MenuItem>
          </div>
        </Menu>
      </Header>
      <Content :style="{padding: '0 50px',marginTop:'20px'}">
        <Card>
          <div style="min-height: 200px;">
            <Nuxt />
          </div>
        </Card>
      </Content>
      <Footer class="layout-footer-center">2011-2016 &copy; TalkingData</Footer>
    </Layout>
  </div>
</template>
<script>
export default {};
</script>
<style scoped>
.layout {
  border: 1px solid #d7dde4;
  background: #f5f7f9;
  position: relative;
  border-radius: 4px;
  overflow: hidden;
}
.layout-logo {
  width: 100px;
  height: 30px;
  background: #5b6270;
  border-radius: 3px;
  float: left;
  position: relative;
  top: 15px;
  left: 20px;
}
.layout-nav {
  margin: 0 10px 0 10px;
  margin-right: 20px;
}
.layout-footer-center {
  text-align: center;
}
</style>

