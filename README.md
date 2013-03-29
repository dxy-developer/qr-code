# QR码生成器 for DXY

针对丁香园站点连接的 QR 码生成器，主要用于手机扫描获取链接等场合。有关 QR 码（QR Code）的相关信息，请参阅：http://en.wikipedia.org/wiki/QR_code 。
 
使用 phpqrcode 类库，具体参见 http://phpqrcode.sourceforge.net/ 。

## 参数

本脚本使用简单，提供对应的 URL 、以及响应的参数即可生成对应 URL ，参数说明如下：

* url  需要生成的对应丁香园链接，（如果不输入同时在丁香园网页中嵌入，则自动使用当前引用页面的地址）
*  format 输出格式，默认 png（图片），还有 text 文字
*  size QR 码的大小，以 27px 为单位的步进，默认值为5
*  margin QR码内容距离边界的值，方便区分周边内容和QR码，默认值为1
* level QR码的密度，默认值为「L」表示稀疏，越稀疏表示点越少图案越简单，同时越容易打印在不同物体上，越密集（最大值为「H」）说明图案的点越多，抗干扰能力越强越容易扫描，参见：

```
L  水平	7%的字碼可被修正
M 水平	15%的字碼可被修正
Q 水平	25%的字碼可被修正
H 水平	30%的字碼可被修正
```

## 例子

![QR码例子](http://api.dxy.cn/qr-code/?url=http://app.dxy.cn/&size=3&margin=1&format=png)

请求连接为：http://api.dxy.cn/qr-code/?url=http://app.dxy.cn/&size=10&margin=1&format=png

QR码扫描的内为 「 http://app.dxy.cn 」（不包括引号）。

--

![QR码例子](http://api.dxy.cn/qr-code/?url=http://dxy.me/6RRZN3&size=5&margin=1&format=png&level=h)

请求连接为： http://api.dxy.cn/qr-code/?url=http://dxy.me/6RRZN3&size=5&margin=1&format=png&level=h

QR码扫描的内为 「 http://dxy.me/6RRZN3 」（不包括引号），级别为 H 水平。

--

如果直接在 DXY 页面中引用，可以不带 URL 参数，那么这会直接使用当前引用页面的网址，例如：

请求连接为： http://api.dxy.cn/qr-code/?size=5&margin=1&format=png&level=h
