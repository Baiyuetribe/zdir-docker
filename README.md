# Docker全自动搭建zdir服务器文件目录列表（含视频教程）

## 前言

本项目手动搭建过程请参考[宝塔面板手动搭建Zdir](https://baiyue.one/archives/456.html) ,在研究过这个程序后，决定docker化这个项目。目前测试基本能用，后台无法删除文件，搭配kodexplorer可以正常使用。使用docker部署，非常迅速，不到一分钟即可完成。

演示：https://wget.ovh

### 主要功能

1. 目录浏览
2. MarkDown文件预览
3. CSS/JavaScript一键复制
4. 查看文件HASH
5. 图片预览
6. 文件索引
7. 显示二维码
8. 文件删除

## 安装运行

首先安装docker【已安装的可跳过】

```
docker version > /dev/null || curl -fsSL get.docker.com | bash 
service docker restart 
systemctl enable docker  #设置开机自启
```

然后执行安装命令

```
mkdir -p /var/zdir
docker run -d -p 8080:80 -v /var/zdir:/var/www/html/var zdir
```

完成后输入http://ip:8080 即可进入首页，搭建成功。

如果想管理文件（上传、下载、删除等操作），请搭配`kodexplorer` 即可。

```
docker run -d -p 899:80 --name kodexplorer -v /var/zdir:/var/www/html/zdir yangxuan8282/kodexplorer
```

### 说明

注意：

1.文件索引刚刚搭建完成后无法正常使用，与宝塔面板手动搭建一样的bug。等很久才会自动刷新出来。

2.文件管理目前无法正常运行，后台上传与前台显示不一致，待解决。

### 后台文件管理

默认账号密码都是`baiyue` 密码无需修改，后台无法删除文件

![](https://ws4.sinaimg.cn/large/007rd8E4ly1g1hib07ktej30mo0690v8.jpg)

### 视频播放

![](https://ws3.sinaimg.cn/large/007rd8E4ly1g1hibs3l5gj30mo0fkgvz.jpg)

## 如果想使用域名访问，请参考如下设置：

**方法一：宝塔反代**
先进入宝塔面板，点击左侧网站，添加站点，完成后进入网站设置，点击反向代理，目标`URL`填入`http://127.0.0.1:代理端口`（*代理端口*就是docker应用的外接接口），再启用反向代理即可。如果想启用`SSL` ，就直接在站点配置即可。

![](https://ww1.sinaimg.cn/large/007i4MEmgy1g04u3wlh5oj30kx0htaci.jpg)

**方法二：caddy反代（没有宝塔时的策略）**

设置较为麻烦，请参考：https://www.moerats.com/archives/422/

**文章来源** ：[佰阅部落](https://baiyue.one/archives/458.html)