In this project, I have created a Java programme with a key size of 1024 bits that performed the following work:

Generate two distinct 512-bit probable primes p and q.
- Calculate the product of these two primes n = pq.
- Calculate the Euler totient function (n).
- Use an encryption exponent e = 65537 and ensure that it is relatively prime to (n). If it is not, go back to Step 1 and generate new values for p and q.
- Compute the value for the decryption exponent d, which is the multiplicative inverse of e mod (n).

After that, I show how encryption and decryption are performed between the sender and the receiver with a message of at least 20 words
