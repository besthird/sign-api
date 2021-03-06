# 签到小程序

# 接口文档

公共入参结构

|  字段   |  类型  |        备注         |  位置  |
| :-----: | :----: | :-----------------: | :----: |
| X-Token | string | 用户授权登录的TOKEN | Header |

公共返回结构

| 字段  |  类型  |     备注     |
| :---: | :----: | :----------: |
| code  |  int   | 错误码 0正常 |
| data  | object |     数据     |

## 用户相关

### 注册

> POST /user/register

- 请求参数

|   字段   |  类型  |            备注            |
| :------: | :----: | :------------------------: |
| username | string |           用户名           |
| password | string | 密码 需要经过一次 md5 转化 |

- 返回参数

|   字段   |  类型  |     备注     |
| :------: | :----: | :----------: |
|  token   | string |  授权TOKEN   |
| registed |  bool  | 是否完成注册 |

### 登录

> POST /user/login

- 请求参数

|   字段   |  类型  |            备注            |
| :------: | :----: | :------------------------: |
| username | string |           用户名           |
| password | string | 密码 需要经过一次 md5 转化 |

- 返回参数

|   字段   |  类型  |     备注     |
| :------: | :----: | :----------: |
|  token   | string |  授权TOKEN   |
| registed |  bool  | 是否完成注册 |

### 微信登录

> POST /user/wxlogin

- 请求参数

| 字段  |  类型  |      备注       |
| :---: | :----: | :-------------: |
| token | string | 小程序授权TOKEN |

- 返回参数

|   字段   |  类型  |     备注     |
| :------: | :----: | :----------: |
|  token   | string |  授权TOKEN   |
| registed |  bool  | 是否完成注册 |

### 完成注册

> POST /user/finish-register

- 请求参数

|   字段   |  类型  |  备注  |
| :------: | :----: | :----: |
| username | string | 用户名 |

### 用户详情

> GET /user/info

- 返回参数

|    字段     |  类型  |     备注      |
| :---------: | :----: | :-----------: |
|     id      |  int   |    用户ID     |
|  username   | string |  用户登录名   |
|  nickname   | string |   用户昵称    |
|   mobile    | string |    手机号     |
| wechat_code | string |    微信号     |
| profession  | string |     职业      |
|   gender    |  int   | 0未知 1男 2女 |
|  head_img   | string |     头像      |

## 会议相关

### 创建|修改会议

> POST /meeting/{id:\d+}

id: 会议ID =0:新建 >0:修改

- 请求参数

|      字段      |  类型  |        备注         |
| :------------: | :----: | :-----------------: |
|     title      | string |      会议标题       |
|    content     | string |      会议内容       |
|   sign_type    |  int   | 1签到2签退3签到签退 |
|   user_limit   |  int   |      参会人数       |
|     status     |  int   |  是否发布0否1发布   |
| sign_in_btime  |  int   |    签到开始时间     |
| sign_in_etime  |  int   |    签到结束时间     |
| sign_out_btime |  int   |    签退开始时间     |
| sign_out_etime |  int   |    签退结束时间     |

### 会议详情

> GET /meeting/{id:\d+}

- 返回参数

|      字段      |  类型  |        备注         |
| :------------: | :----: | :-----------------: |
|       id       |  int   |       会议ID        |
|     title      | string |      会议标题       |
|    content     | string |      会议内容       |
|   sign_type    |  int   | 1签到2签退3签到签退 |
|   user_limit   |  int   |      参会人数       |
|     status     |  int   |  是否发布0否1发布   |
| sign_in_btime  |  int   |    签到开始时间     |
| sign_in_etime  |  int   |    签到结束时间     |
| sign_out_btime |  int   |    签退开始时间     |
| sign_out_etime |  int   |    签退结束时间     |

### 用户会议列表

> GET /meeting

- 返回参数

|      字段      |  类型  |        备注         |
| :------------: | :----: | :-----------------: |
|       id       |  int   |       会议ID        |
|     title      | string |      会议标题       |
|    content     | string |      会议内容       |
|   sign_type    |  int   | 1签到2签退3签到签退 |
|   user_limit   |  int   |      参会人数       |
|     status     |  int   |  是否发布0否1发布   |
| sign_in_btime  |  int   |    签到开始时间     |
| sign_in_etime  |  int   |    签到结束时间     |
| sign_out_btime |  int   |    签退开始时间     |
| sign_out_etime |  int   |    签退结束时间     |
|      user      | array  |      用户信息       |

### 删除会议

> POST /meeting/del

- 请求参数

| 字段  | 类型  |  备注  |
| :---: | :---: | :----: |
|  id   |  int  | 会议id |

### 会议二维码

> GET /meeting/{id:\d+}/qrcode

- 返回参数

|    字段     | 类型  |          备注           |
| :---------: | :---: | :---------------------: |
| is_download |  int  | 1下载二维码 0展示二维码 |

## 签到相关

### 签到

> POST /sign/{id:\d+}

id: 会议ID

- 请求参数

|    字段     |  类型  |      备注       |
| :---------: | :----: | :-------------: |
|    type     |  int   |   1签到 2签退   |
|  nickanme   | string |      昵称       |
|   mobile    | string |  手机号 非必填  |
| wechat_code | string |  微信号 非必填  |
|    data     | array  | 额外数据 非必填 |

### 我的签到记录

> GET /sign

- 请求参数

|  字段  | 类型  |   备注   |
| :----: | :---: | :------: |
| offset |  int  | 分页参数 |
| limit  |  int  | 分页参数 |

- 返回参数

|        字段         |  类型  |    备注     |
| :-----------------: | :----: | :---------: |
|        count        |  int   |  签到总数   |
|        items        | array  |  签到记录   |
|  items.meeting_id   |  int   |   会议ID    |
|     items.type      |  int   | 1签到 2签退 |
|    items.user_id    |  int   |   用户ID    |
|   items.nickname    | string |  签到昵称   |
|    items.mobile     | string | 签到手机号  |
|  items.wechat_code  | string | 签到微信号  |
|     items.data      | object |  额外数据   |
|    items.meeting    | object |  会议信息   |
| items.meeting.title | string |  会议标题   |

### 参与的会议

> GET /sign/get-user-meeting

- 请求参数

|    字段    | 类型  |   备注   |
| :--------: | :---: | :------: |
| meeting_id |  int  |  会议id  |
|   offset   |  int  | 分页参数 |
|   limit    |  int  | 分页参数 |

- 返回参数

|    字段     |  类型  |     备注     |
| :---------: | :----: | :----------: |
|    count    |  int   | 签到会议总数 |
| items.title | string |   会议标题   |

### 会议下的签到记录

> GET /sign/get-meeting

- 请求参数

|    字段    | 类型  |   备注   |
| :--------: | :---: | :------: |
| meeting_id |  int  |  会议id  |
|   offset   |  int  | 分页参数 |
|   limit    |  int  | 分页参数 |

- 返回参数

|        字段         |  类型  |    备注     |
| :-----------------: | :----: | :---------: |
|        count        |  int   |  签到总数   |
|        items        | array  |  签到记录   |
|  items.meeting_id   |  int   |   会议ID    |
|     items.type      |  int   | 1签到 2签退 |
|    items.user_id    |  int   |   用户ID    |
|   items.nickname    | string |  签到昵称   |
|    items.mobile     | string | 签到手机号  |
|  items.wechat_code  | string | 签到微信号  |
|     items.data      | object |  额外数据   |
|    items.meeting    | object |  会议信息   |
| items.meeting.title | string |  会议标题   |

### 导出签到
>/sign/export-excul
