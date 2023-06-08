# 本项目已更新GPT-4以及GPT-4-32k模型，现在免费加群讨论，快速掌握前沿技术！欲加从速！

# 介绍
Steller集成第一版市面上放出来的代码以及市面上全部基于第一版源码的二开版本，并且加了后台以及数据库功能，对此表示对所有贡献者表示感谢。
以下是相对应的的介绍
可以点击下方链接查看样式体验：

>>>>https://chat.stellar.hk

![123](https://github.com/stellarhk/ChatGPT4.0-Web-Stellar/assets/128345288/a784d30e-a4b5-419f-be4e-0130ba2dcae3)

**2023-05-10更新版本日志：**

1. 更新GPT-4以及GPT-4-32k模型
2. 优化了代码显示逻辑
3. 修复了部分已知BUG
------
**2023-03-16更新版本日志：**

1. 支持表格和公式的显示
2. 优化了代码显示逻辑

------
**2023-03-11更新版本日志：**

1. 支持多行输入，文本框高度自动调节
3. AI回答途中可以随时打断
4. 增加了API_KEY被封禁和未提供API_KEY错误的提示
5. 增加了一些预设话术
6. 对手机浏览器进行了适配优化
7. 修复了AI回复内容包含某些代码时，显示效果异常的bug
8. 增加了代码复制按钮

**PHP版调用OpenAI的API接口进行问答的Demo，代码已更新为调用最新的gpt-3.5-turbo模型。
采用Stream流模式通信，一边生成一边输出，响应速度超过官网。前端采用JS的EventSource，还将Markdown格式文本进行了排版，对代码进行了着色处理。服务器记录所有访问者的对话日志。**

很多人想要Demo网站中自己输入API-KEY的功能，已经把代码加上了，取消index.php的注释就行了。为了美观可以把上面的“连续对话”部分注释掉，要不然手机访问不是很友好。

在国内访问OpenAI的新接口会提示超时，如果你本地有HTTP-PROXY，可以把stream.php里面注释掉的“curl_setopt($ch, CURLOPT_PROXY, " http://127.0.0.1:1081 ");”修改一下，这样就可以通过你本地的代理访问openai的接口。

如果你自己没代理，可以使用热心网友提供的反代地址，把“curl_setopt($ch, CURLOPT_URL, ' https://api.openai.com/v1/chat/completions ');”这行里面的网址改成' https://openai.1rmb.tk/v1/chat/completions '，不确定那个什么时候会失效，也可以进群再找其他群友求一个。不过反代的方式访问速度比较慢，最好还是自己买个海外服务器吧，每个月不到20元的有的是。

<img width="1086" alt="237388643-c0731edf-aa9f-4f77-927e-5a62b2c9f3e8" src="https://github.com/stellarhk/ChatGPT4.0-Web-Stellar/assets/128345288/74595406-f710-4b89-a03b-41a76110776d">

*测试网址：http://chat.stellar.hk* 

------

核心代码只有几个文件，没有用任何框架，修改调试很方便，只需要修改stream.php中的API_KEY即可使用。

index.php前面的代码还可以实现区分内外网IP，内网直接访问，外网通过BASIC认证后可访问。可以根据需要删掉注释并进行修改。

部署好了可以放在公司内网，让同事们一起体验chatGPT的强大功能。也可以发到朋友圈分享，互联网技术大牛的形象直接拉满。


FAQ：

之前OpenAI官方API提供的最先进的模型是text-davinci-003，比官网的ChatGPT稍弱一些。最近OpenAI终于放出了gpt-3.5-turbo模型，理论上和官网的ChatGPT几乎没区别了。只是由于接口限制，问题和答案最多4096个tokens，实测1个汉字算2个tokens。


对chatgpt感兴趣的同学们欢迎加群讨论。群里有很多大神，有问题可以互相帮助。如果需要在本项目基础上进行二次开发或者其他商务合作，可以加我微信沟通。


![2](https://github.com/stellarhk/ChatGPT4.0-Web-Stellar/assets/128345288/91ab95c7-8a32-4337-a672-353040ac3907)
![图片_20230608170321](https://github.com/stellarhk/chatgpt/assets/128345288/0ee07002-c1bb-4549-aeeb-23ace0a2ec81)
![图片_20230530152225](https://github.com/stellarhk/ChatGPT4.0-Web-Stellar/assets/128345288/c8ef2c7a-8ad5-453d-a922-85bd03a84916)
