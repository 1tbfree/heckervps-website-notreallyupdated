import discord
from discord.ext import commands
import sqlite3

bot = commands.Bot(command_prefix='!')

@bot.command()
async def verify(ctx, code: str):
    # Connect to SQLite database
    conn = sqlite3.connect('users.db')
    cursor = conn.cursor()

    # Check if the verification code exists and is not yet verified
    cursor.execute("SELECT * FROM users WHERE verification_code = ? AND verified = 0", (code,))
    user = cursor.fetchone()

    if user:
        # Update user as verified
        cursor.execute("UPDATE users SET verified = 1 WHERE verification_code = ?", (code,))
        conn.commit()
        await ctx.send("Verification successful! You can now use the HeckerVPS services.")
    else:
        await ctx.send("Invalid verification code or already verified.")

    conn.close()

bot.run('YOUR_BOT_TOKEN')
