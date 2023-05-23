# ctfn.pro

🔒 **CTFN.PRO** is a service for generating **soul-bound NFT-certificates** that are stored on the BNB Chain blockchain. The certificate is signed by an educational organization and is transferred to the student’s crypto wallet.

🌟 Once the certificate is issued, it can be viewed on the CTFN.PRO service, in the student's digital wallet, and in transaction explorers on the BNB Chain blockchain.

CTFN.pro builds decentralized **on-chain reputation system**. It can be SocialFi platform which connect students, educational institutions and employers (hr managers). Students can share link to their NFT-certificates on social networks. 

CTFN is short for **C**ER**T**I**F**ICATIO**N**. If you read it from right to left, you get **NFT**C - NFT-certificate.

## Features

🎉 Advantages of the platform that have already been implemented:

+ 🎓 Creation of an NFT token for an educational organization
+ 🔍 Generation of name certificates on the service or via API (using JS)
+ 💻 Viewing of all certificates issued by the organization on one page
+ 👀 Search and verification of NFT certificates

🔒 The certificate is generated as a soul bound token to prevent it from being passed on to third parties. The educational organization can post the address of the Metamask wallet to which the organization's token is generated on its official website, so that anyone can verify that the certificates are signed by it.

The functionality of the service is available in two languages: English and Russian. You can switch the language at the bottom of the page.

Features that are in development are listed in the Roadmap section.

## How it Works
How does it work?
1. Educational organization generates their own token.
    Educational organization creates an account and generates a smart contract token for minting NFT-certificates.
2. Student provides cryptowallet address.
    Upon completion of the course, the student requests an NFT-certificate by providing their cryptocurrency wallet address to the educational organization, which can be submitted manually, through API, or a Google Form.
3. Educational organization issues the certificate to wallet.
    After confirming the completion of the course, educational organization mints the NFT-certificate and sends it to the student's crypto wallet address. The NFT-certificate is a soulbound token that cannot be  transferred to third parties.
4. Visualize and share NFT-certificate.
    The student can import the NFT-certificate into their cryptowallet (MetaMask, Trustwallet) to visualize it and share it on social media or include it in their resume for potential employers.
5. Verify authenticity on CTFN.pro or blockchain.
    Employers can verify the authenticity of the certificate by simply checking the token ID and address on CTFN.pro or the Binance(BNB) Blockchain Explorer.

[Visualization (scheme)](https://github.com/Arnion/ctfn.pro/assets/6169475/9f354e17-980c-4bb4-afeb-ec4a18acf871) (recommended to open in a new window)

[User guide is available here](USER-GUIDE.md)
+ [Educational organization](USER-GUIDE.md)
+ [Student](USER-GUIDE.md#student)
+ [Employers and HR-managers](USER-GUIDE.md#employers-and-hr-managers)


### Videodemo
Short video demonstration:

[CTFN demo integration 10 частота вместое 30 качество 50 аудио качество 50.webm](https://github.com/Arnion/ctfn.pro/assets/6169475/c374f2aa-68e5-4e5b-868b-dd0909d662a7)

On YouTube (high qulity): https://youtu.be/OfDCVzMajMY


## 🛠️Technologies
+ 🔗 BNB Chain as a blockchain to store organization tokens and certificates
+ 💻 Solidity as a language for writing smart contracts
+ 🎨 Yii2 + MySQL for front-end development
+ 🌐 JavaSctipt for integrating the service on third-party platforms

[Installation Instructions](src/README.md)

Tested certificate mapping in Metamask crypto wallets (after importing NFT) and TrustWallet (NFT is loaded automatically).

## ✅ Real deal!
To test the functionality of the service, we developed an integration with the LMS platform AutoOffice and held a training webinar for students of one of the educational organizations.

More than 60 certificates was mint in BNB Chain mainnet!

[Read more about results and view code](autooffice_integration)

## 🛣️ Roadmap
We started developing CTFN service during Zero2Hero Bootcamp by Blockchain Center (Kazakhstan) and BNB Chain in March 2023.


We plan to add the following features to the service:
+ 🎓A personal account of the student with the ability to hide the name from the certificates themselves, the management of the public portfolio. All certificates confirming a student's skills are collected in one place.
+ 🎨Certificate design customization: ability to upload and edit your own templates. Appearance animation.
+ 📊Integration with Google Spreadsheet, which will allow uploading lists to generate NFT certificates and speed up the graduation process. With this feature students can submit their wallet address through the Google Form. The educational organization will immediately receive a list of those who wish to receive an NFT certificate.
+ 🤖An API to communicate with popular LMS platforms that will allow certificates to be generated automatically after a student completes a course
+ 💰Running utility token on BNB Chain
  + Organizations will be able to pay for certificates with a token and verify their site.
  + Students will be able to customize their profile and gain premium status on the platform. Mark their profile as Open to Work so employers can find them
  + Employers (hr managers) will be able to contact students with Open to Work status if their skills (verified by certificates) are suitable for them

### 😎 Team:
An experienced team of managers and developers, more than 10 years in online education. We have a good understanding of how EdTech works and how to make SaaS IT products

+ **Sergei Sadkov** (CEO, founder)
    Made his first educational startup in 2008.
    Winner of contest of ideas for implementation of digital tenge by the National Bank of Kazakhstan.
    Creator of the Crypto SDK YouTube Channel.
+ **Andrei Aniskov** (Web 2 Developer)
    10+ years experience in programming, Fullstack,
    PHP, Yii2, MySQL, JS
+ **Nikita Pivikov** (Web 3 Developer)
    5+ years in programming, Fullstack,
    Solidity, PHP, JS
+ **Rauana Madiarova** (Product Manager)
    Bachelor of Science in Computer Science, Front-end
    React.JS, JS

### 🤝 Potential partners:
+ 🔑 Cryptoprojects:
  + Cryptoprojects can issue certificates on learning their functionality. It is possible to create a smart contract that will issue cryptoproject tokens after issuing a certificate.
  + Crypto-exchanges. For example, the crypto-exchange Binance may issue certificates after a user passes tests or achieves any results. 
+ 🎓 Educational organizations selling online courses
  + CTFN.pro will become for them a convenient depository of certificates
  + NFT certificate will increase your company's reputation by increasing their sales.
+ 👨‍🏫 LMS-platforms - a great opportunity to connect to many educational institutions
+ 👥 Job search sites 
  + Students can connect NFT certificates to their resume, making it more sheltered
  + HR can look for employees whose knowledge is verified


## 🔗 Links
Website: https://ctfn.pro/

Twitter: https://twitter.com/CtfnPro
