## Finance Theme Development Environment Setup

This document outlines the steps required to set up your development environment for the Finance Theme project, utilizing the provided `package.json`, `composer.json`, and `.nvmrc` files.

**Software Requirements:**

* PHP 7.4 or higher
* Composer
* **Node.js (specific version managed by nvm)**. Use `nvm install` to install the version specified in the `.nvmrc` file.
* Git

**1. Install nvm:**

If you haven't already, follow the instructions below to install nvm for your operating system:

* **Linux:**

```
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
```

* **Mac:**

```
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
```

* **Windows:**

Download and install the nvm installer for your system from [https://github.com/coreybutler/nvm-windows/releases](https://github.com/coreybutler/nvm-windows/releases).

**2. Install Node.js:**

Once nvm is installed, run the following command to install the Node.js version specified in the `.nvmrc` file:

```
nvm install
```

**3. Verify Node.js version:**

To verify that the correct Node.js version is installed, run:

```
node -v
```

**4. Install Composer:**

Download and install Composer for your operating system: [https://getcomposer.org/download/](https://getcomposer.org/download/).

**5. Verify Composer installation:**

Run the following command to verify Composer installation:

```
php -r "readfile('https://getcomposer.org/installer');" | php
```

**6. Install PHP Dependencies:**

Navigate to your project directory and run the following command to install the PHP dependencies defined in `composer.json`:

```
composer install
```

**7. Install Node.js Dependencies:**

Run the following command to install the Node.js dependencies defined in `package.json`:

```
npm install
```

**8. Configure Husky:**

Run the following command to install Husky:

```
npm run prepare
```

**9. Linting and Code Style:**

This project uses PHP CodeSniffer (PHPCS) and WP Coding Standards (WPCS) for linting and code style enforcement.

* **Run the linter:**

```
npm run lint
```

* **Automatically fix code style violations:**

```
npm run fix
```

**10. Development Workflow:**

* **Start new work on a new branch:** Before starting new work, create a new branch from the main branch using `git checkout -b <branch_name>`.
* **Commit your changes to your branch:** Once you've made changes, commit them to your branch using `git commit -m "<commit message>"`.
* **Push your changes to the remote repository:** To share your changes with other developers, push your branch to the remote repository using `git push origin <branch_name>`.
* **Create a pull request:** To merge your changes into the main branch, create a pull request from your branch to the main branch.

**Available Scripts:**

* `npm run lint`: Runs the PHP linter.
* `npm run fix`: Fixes code style violations automatically.
* `composer run lint:php`: Runs the PHP linter. (alias for `npm run lint`)
* `composer run fix:php`: Fixes code style violations automatically. (alias for `npm run fix`)
* `npm run prepare`: Installs Husky.

**Additional Notes:**

* This README provides a high-level overview of the development environment setup. Refer to the official documentation of Composer, Node.js, and nvm for detailed information.
* Consider using tools like IDEs or code editors with integrated support for PHP and JavaScript for a more efficient development experience.

**Troubleshooting:**

* If you encounter any issues during setup, consult the documentation of the respective tools.
* Check for any errors or warnings displayed during the installation process.
* Consider searching online for solutions specific to your encountered problems.

**Enjoy developing with the Finance Theme!**
